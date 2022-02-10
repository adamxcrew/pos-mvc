<?php

class Pos extends Controller
{
    public function index()
    {
        $data['product'] = $this->model('ProductModel')->getAllData();
        // echo "<pre>";
        // var_dump($data['product']);
        // echo "</pre>";
        // exit;
        $this->view('templates/header');
        $this->view('pos/index', $data);
    }

    public function cart($id)
    {
        $id_product = $id;
        // var_dump($id_product);

        if (isset($_SESSION['cart'][$id_product])) {
            $_SESSION['cart'][$id_product] += 1;
        } else {
            $_SESSION['cart '][$id_product] = 1;
        }
        var_dump($_SESSION['cart']);
        // header('location: ' . BASEULR . '/pos');
        // exit;
    }
}
