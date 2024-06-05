<?php

class TransactionModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTransaction()
    {
        $sql = "SELECT * FROM tb_transaction";
        return $this->db->getAll($sql);
    }

    public function transaction($invoice, $iduser, $payment, $total, $date)
    {
        $sql = "INSERT INTO tb_transaction (invoice_number, iduser, payment, total, created_at) VALUES ('$invoice', $iduser, $payment, $total, '$date')";
        return $this->db->runSQL($sql);
    }

    public function getLastInvoice()
    {
        $query = "SELECT * FROM tb_transaction ORDER BY invoice_number DESC LIMIT 1";
        return $this->db->getItem($query);
    }

    public function addTransactionProduct($idproduct, $invoice, $qty, $date)
    {
        $sql = "INSERT INTO tb_product_transaction (idproduct, invoice_number, quantity, created_at) VALUES ('$idproduct','$invoice', $qty, '$date')";
        return $this->db->runSQL($sql);
    }

    public function getDataByID($id)
    {
        $sql = "SELECT p.name, p.description, p.price, t.total, tr.quantity FROM tb_product AS p
        INNER JOIN tb_product_transaction AS tr ON tr.idproduct = p.idproduct
        INNER JOIN tb_transaction AS t ON t.invoice_number = tr.invoice_number
        WHERE t.id_transaction = $id";
        return $this->db->getAll($sql);
    }

    public function deleteData($id)
    {
        $sql = "DELETE FROM tb_transaction WHERE id_transaction = $id";
        return $this->db->runSQL($sql);
    }

    public function invoiceNumber($id)
    {
        $sql = "SELECT invoice_number FROM tb_transaction WHERE id_transaction = $id";
        return $this->db->getItem($sql);
    }

    public function deleteProductTransaction($invoice)
    {
        $sql = "DELETE FROM tb_product_transaction WHERE invoice_number IN('$invoice')";
        return $this->db->runSQL($sql);
    }

    public function chartLabel()
    {
        $sql = "SELECT * FROM tb_product_transaction AS pt 
        INNER JOIN tb_product AS p
        ON pt.idproduct = p.idproduct GROUP BY p.name";
        return $this->db->getAll($sql);
    }

    public function chartData()
    {
        $sql = "SELECT SUM(pt.quantity) AS sold FROM tb_product_transaction as pt 
        INNER JOIN tb_product as p 
        ON pt.idproduct=p.idproduct GROUP BY p.name";
        return $this->db->getAll($sql);
    }
}
