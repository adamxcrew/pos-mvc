<?php

class Product extends Controller
{
    public function index()
    {
        $data['product'] = $this->model('ProductModel')->getAllData();

        $this->view('templates/header');
        $this->view('product/index', $data);
    }

    public function create()
    {
        if ($this->model('ProductModel')->addDataProduct($_POST) > 0) {
            Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEURL . '/product');
            exit;
        } else {
            Flasher::setMessage('Failed', 'added', 'danger');
            header('location: ' . BASEURL . '/product');
            exit;
        }
    }
}
