<?php

class Pos extends Controller
{
    protected $id_product;

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

    public function cart($id)
    {
        $item = [];
        $this->id_product = $id;
        $data = $this->model('ProductModel')->getItemById($this->id_product);
        // array(2) {
        //     ["idproduct"]=> string(1) "1"
        //     ["name"]=> string(10) "Baju Erigo"
        //     ["price"]=> string(6) "120000"
        //   }
        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        if (isset($_SESSION['cart'][$this->id_product])) {
            $_SESSION['cart'][$this->id_product]++;
        } else {
            $_SESSION['cart'][$this->id_product] = 1;
        }
        $_SESSION['cart'];
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'] == $data['idproduct']) {
                $item[] = $data;
                echo "<pre>";
                var_dump($item);
                echo "</pre>";
            }
        }
        // array(1) {
        //   [1]=>
        //   int(2)
        // }
        // array(1) {
        //   [1]=>
        //   int(2)
        //   [2]=>
        //   int(1) 
        // }
        echo "<pre>";
        var_dump($_SESSION['cart']);
        echo "</pre>";
        exit;
        header('location: ' . BASEULR . '/pos');
    }
}
