<?php

class Product extends Controller
{
    public function __construct()
    {
        if (($_SESSION['session_login'] != 'Login')) {
            header('location: ' . BASEULR . '/auth');
            exit;
        }
    }
    public function index()
    {
        $data['product'] = $this->model('ProductModel')->getAllData();

        $this->view('templates/header');
        $this->view('product/index', $data);
    }

    public function create()
    {
        if ($this->model('ProductModel')->addDataProduct($_POST) == true) {
            // Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        } else {
            Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        }
    }
}
