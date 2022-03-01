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
        $this->id_product = $id;
        $data = $this->model('ProductModel')->getItemById($id);

        if (isset($_SESSION['cart'][$this->id_product])) {
            if ($_SESSION['cart'][$this->id_product]['value'] == $data['quantity']) {
                Flasher::setMessage('Quantity Cart Exceeds Stock', 'Wrong', 'danger');
                header('location: ' . BASEULR . '/pos');
                exit;
            } else {
                $_SESSION['cart'][$this->id_product]['value'] += 1;
            }
        } else {
            $_SESSION['cart'][$this->id_product]['value'] = 1;
        }

        array_push($_SESSION['cart'][$this->id_product], $data);

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

    public function search()
    {
        $output = "";
        if (isset($_POST['search'])) {
            $data['product'] = ($this->model('ProductModel')->search($_POST['search']));
            echo json_encode($data);
        }
    }

    public function payment()
    {
        if (isset($_SESSION['cart'])) {
            $total = 0;
            $item = $_SESSION['cart'];
            // get session
            foreach ($item as $row) {
                $data = [
                    'value' => $row['value'],
                    'idproduct' => $row[0]['idproduct']
                ];
                $dataIdentf[] = $data;
            }

            // get data cart
            for ($i = 0; $i < count($dataIdentf); $i++) {
                $id = $dataIdentf[$i]['idproduct'];
                $product[] = $this->model('ProductModel')->getItemById($id);
            }

            // Add into tb_transaction
            $payment = $_POST['payment'];
            $userid = $_SESSION['iduser'];
            for ($i = 0; $i < count($dataIdentf); $i++) {
                $total = $total + $dataIdentf[$i]['value'] * $product[$i]['price'];
                // Add tb_product_transaction
                $this->model('TransactionModel')->addTransactionProduct($dataIdentf[$i]['idproduct'], $dataIdentf[$i]['value']);
            }
            $this->model('TransactionModel')->transaction($userid, $payment, $total);

            // update qyt, add into tb_transaction
            for ($i = 0; $i < count($dataIdentf) + 1; $i++) {
                if ($dataIdentf[$i]['value'] < $product[$i]['quantity']) {

                    // update qty on tb_product
                    $qty = $product[$i]['quantity'] - $dataIdentf[$i]['value'];
                    $this->model('ProductModel')->updateQty($product[$i]['idproduct'], $qty);
                    unset($_SESSION['cart'][$product[$i]['idproduct']]);
                } else {
                    header('location: ' . BASEULR . '/transactions');
                    exit;
                }
            }
        }
    }
}
