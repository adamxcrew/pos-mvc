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
        if (isset($_POST['search'])) {
            $output = "";
            $data['product'] = ($this->model('ProductModel')->search($_POST['search']));
            if ($data['product'] > 0) {
                foreach ($data['product'] as $row) {
                    $output .= '
                    <div class="card text-center mb-3" style="width: 17rem;">
                    <img class="card-img-top mt-2" src="uploads/' . $row['image'] . '" style="object-fit: content; width:100%; height:130px" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">' . $row['name'] . '</h5>
                        <h6 class="font-weight-bold" style="color: red;">' . number_format($row['price'], 2, ',', '.') . '</h6>
                        <a href="' . BASEULR . '/pos/cart/' . $row['idproduct'] . '" class="btn btn-primary">Add To Cart <i class="fas fa-cart-plus"></i> </a>
                    </div>
                </div>';
                }
                echo $output;
            } else {
                $output = "<h4 class='text-danger'>Data Not Found</h4>";
                echo $output;
            }
        }
    }

    public function payment()
    {
        if (isset($_SESSION['cart'])) {
            $tax = $_POST['tax'];
            // exit(Service::show($tax));
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
            $this->transactionProduct($dataIdentf);
            $this->model('TransactionModel')->transaction($userid, $payment, $this->getTotal($dataIdentf, $product, $tax));

            // update qyt, add into tb_transaction
            $this->updateAddTransaction($dataIdentf, $product);
        }
    }

    protected function getTotal($dataIdentf, $product, $tax)
    {

        $total = 0;
        for ($i = 0; $i < count($dataIdentf); $i++) {
            $total = $total + $dataIdentf[$i]['value'] * $product[$i]['price'];
        }
        return $total + (int) $tax;
    }

    protected function transactionProduct($dataIdentf)
    {
        for ($i = 0; $i < count($dataIdentf); $i++) {
            $this->model('TransactionModel')->addTransactionProduct($dataIdentf[$i]['idproduct'], $dataIdentf[$i]['value']);
        }
    }

    protected function updateAddTransaction($dataIdentf, $product)
    {
        for ($i = 0; $i < count($dataIdentf); $i++) {
            if ($product[$i]['quantity'] > $dataIdentf[$i]['value']) {
                // update qty on tb_product
                $qty = $product[$i]['quantity'] - $dataIdentf[$i]['value'];
                $this->model('ProductModel')->updateQty($product[$i]['idproduct'], $qty);
                unset($_SESSION['cart'][$product[$i]['idproduct']]);
                header('location: ' . BASEULR . '/transactions');
            }
        }
    }
}
