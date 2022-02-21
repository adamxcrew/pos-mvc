<?php

class Pos extends Controller
{
    protected $id_product;
    protected $cart;

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
        $this->view('pos/index', $data);
        $this->view('templates/footer');
    }

    public function cart($id = '')
    {
        // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $this->id_product = $id;
        $data = $this->model('ProductModel')->getItemById($id);

        if (isset($_SESSION['cart'][$this->id_product])) {
            $_SESSION['cart'][$this->id_product]['value'] += 1;
        } else {
            $_SESSION['cart'][$this->id_product]['value'] = 1;
        }

        $items = array_push($_SESSION['cart'][$this->id_product], $data);
        // Service::show($items);
        // Opsi 2
        // if (isset($_SESSION['cart'])) {
        //     $cart = $_SESSION['cart'];
        // } else {
        //     $cart = [];
        // }

        // $cart[$id] = [
        //     'idproduct' => $data['idproduct'],
        //     'name' => $data['name'],
        //     'price' => $data['price'],
        //     'qty' => 1
        // ];

        header('location: ' . BASEULR . '/pos');
        exit;
    }

    public function decrement()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $_SESSION['cart'][$id]['value'] -= 1;

            if ($_SESSION['cart'][$id]['value'] == 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            unset($_SESSION['cart'][$id]);
        }
    }
}
