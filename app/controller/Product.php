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
        $this->view('templates/footer');
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

    public function getdata()
    {
        $id = $_POST['id'];
        echo json_encode($this->model('ProductModel')->getItem($id));
    }

    public function editdata()
    {
        // exit(Service::show($this->model('ProductModel')->edit($_POST)));
        if ($this->model('ProductModel')->edit($_POST) == true) {
            // Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        } else {
            // Flasher::setMessage('Sucess', 'added', 'success');
            header('location: ' . BASEULR . '/product');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('ProductModel')->delete($id) == true) {
            Flasher::setMessage('succeed', 'deleted', 'success');
            header('Location: ' . BASEULR . '/product');
            exit;
        } else {
            Flasher::setMessage('failed', 'deleted', 'danger');
            header('Location: ' . BASEULR . '/pos');
            exit;
        }
    }
}
