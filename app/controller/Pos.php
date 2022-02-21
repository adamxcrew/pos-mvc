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
    }

    public function cart($id = '')
    {
        // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $this->id_product = $id;
        $data = $this->model('ProductModel')->getItemById($id);

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = [];
        }

        $cart[$id] = [
            'idproduct' => $data['idproduct'],
            'name' => $data['name'],
            'price' => $data['price'],
            'qty' => 1
        ];

        $_SESSION['cart'] = $cart;
        // if (isset($_SESSION['cart'][$this->id_product])) {
        //     $_SESSION['cart'][$this->id_product] += 1;
        // } else {
        //     $_SESSION['cart'][$this->id_product] = 1;
        // }
        Service::show($cart[$id]['idproduct']);
        Service::show($cart[$id]);
        // Service::show($_SESSION['cart']);
        // header('location: ' . BASEULR . '/pos');
        exit;
    }
}
