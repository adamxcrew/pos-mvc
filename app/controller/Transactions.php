<?php

class Transactions extends Controller
{

    public function index()
    {
        $data = $this->model('TransactionModel')->getTransaction();
        $this->view('templates/header');
        $this->view('transactions/index', $data);
        $this->view('templates/footer');
    }

    public function getItem()
    {
        $id = $_POST['id'];
        echo json_encode($this->model('TransactionModel')->getDataByID($id));
    }

    public function delete($id)
    {
        $invoice = $this->getInvoice($id);
        $this->model('TransactionModel')->deleteProductTransaction($invoice['invoice_number']);
        if ($this->model('TransactionModel')->deleteData($id) > 0) {
            header('Location: ' . BASEULR . '/transactions');
            exit;
        }
    }



    private function getInvoice($id)
    {
        return $this->model('TransactionModel')->invoiceNumber($id);
    }
}
