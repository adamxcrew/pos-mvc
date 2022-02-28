<?php

class Transactions extends Controller
{

    public function index()
    {
        $data = $this->model('TransactionModel')->getTransaction();
        // foreach ($data as $row) {
        //     Service::show($row);
        // }
        // exit;
        $this->view('templates/header');
        $this->view('transactions/index', $data);
        $this->view('templates/footer');
    }
}
