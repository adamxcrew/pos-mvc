<?php

class Chart extends Controller
{
    public function index()
    {
        $data['label'] = $this->model('TransactionModel')->chartLabel();
        $data['data'] = $this->model('TransactionModel')->chartData();
        // Service::show($data);

        $this->view('templates/header');
        $this->view('chart/index', $data);
        $this->view('templates/footer');
    }
}
