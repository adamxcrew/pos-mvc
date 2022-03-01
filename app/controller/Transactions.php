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
}
