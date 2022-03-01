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

    public function transaction($iduser, $payment, $total)
    {
        $date = date('Y-m-d');
        $invoice = $this->generateInvoice();

        $sql = "INSERT INTO tb_transaction VALUES ('','$invoice', $iduser, $payment, $total, '$date')";
        return $this->db->runSQL($sql);
    }

    private function getLastInvoice()
    {
        $query = "SELECT * FROM tb_transaction ORDER BY invoice_number DESC LIMIT 1";
        return $this->db->getItem($query);
    }

    public function addTransactionProduct($idproduct, $qty)
    {
        $invoice = $this->generateInvoice();
        $date = date('Y-m-d');
        $sql = "INSERT INTO tb_product_transaction VALUES ('','$idproduct','$invoice', $qty, '$date')";
        return $this->db->runSQL($sql);
    }

    private function generateInvoice()
    {
        $row = $this->getLastInvoice();
        $number = substr($row['invoice_number'], 7);
        if ($this->getLastInvoice() == null) {
            $invoe = 'T' . date('y') . date('m') . str_pad(1, 3, '0', STR_PAD_LEFT);
        } else {
            $invoe = 'T' . date('y') . date('m') . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        }
        return $invoe;
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
}
