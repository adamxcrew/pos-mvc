<?php

class Chart extends Controller
{
    public function __construct()
    {
        Service::checkLogin();
    }

    public function index()
    {

        // $date = Service::convertMonth(date("Y-m-d"));
        // // exit(Service::show($tangg));

        $data['label'] = $this->model('TransactionModel')->chartLabel();
        $data['data'] = $this->model('TransactionModel')->chartData();
        $data['product'] = $this->model('ProductModel')->getAllData();
        // Service::show($data['product']);

        $this->view('templates/header');
        $this->view('chart/index', $data);
        $this->view('templates/footer');
    }
}
