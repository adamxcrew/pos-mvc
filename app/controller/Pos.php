<?php

class Pos extends Controller
{
    public function index()
    {
        // $data['product'] = $this->model('ProductModel')->getAllData();

        $this->view('templates/header');
        $this->view('pos/index');
    }
}
