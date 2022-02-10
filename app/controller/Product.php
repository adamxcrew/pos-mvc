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
        if ($this->model('ProductModel')->addDataProduct($_POST) == true) {
            // echo "Berhasil";
            Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        } else {
            // echo "Gagal";
            Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        }
    }
}
