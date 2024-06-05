<?php

class Pos extends Controller
{
    protected $id_product;
    public function __construct()
    {
        Service::checkLogin();
    }

    public function index()
    {
        $data['product'] = $this->model('ProductModel')->getAllData();
        $this->view('templates/header');
        $this->view('pos/index', $data);
        $this->view('templates/footer');
    }

    public function cart($id)
    {
        $data = $this->model('ProductModel')->getItem($id);
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'item' => [
                    'id_product' => $data['idproduct'],
                    'product_name' => $data['name'],
                    'product_price' => $data['price'],
                    'qty_product' => $data['quantity']
                ],
                'qty' => 1
            ];
        } else {
            if ($data['quantity'] <= $_SESSION['cart'][$id]['qty']) {
                Flasher::setMessage('Quantity Cart Exceeds Stock', 'danger', 'danger');
                header('location: ' . BASEULR . '/pos');
                exit;
            } else {
                $_SESSION['cart'][$id]['qty'] += 1;
            }
        }
        header('location: ' . BASEULR . '/pos');
        exit;
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            unset($_SESSION['cart'][$id]);
        }
    }

    public function decrementcart()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $_SESSION['cart'][$id]['qty'] -= 1;

            if ($_SESSION['cart'][$id]['qty'] == 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    public function payment()
    {
        $cartQuantity = $this->getTotalCart();
        $date = date('Y-m-d');
        $invoice = $this->generateInvoice($cartQuantity);
        // insert ke tb transaction
        $this->model('TransactionModel')->transaction($invoice, $_SESSION['iduser'], $_POST['payment'], $_POST['total'], $date);

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key) {
                // echo "<pre>";
                // var_dump($key);
                // echo "</pre>";
                $updateQyt = $key['item']['qty_product'] - $key['qty'];
                // insert ke tabel produk transaction
                $this->model('TransactionModel')->addTransactionProduct($key['item']['id_product'], $invoice, $key['qty'], $date);
                // Update quantity di tabel product
                $this->model('ProductModel')->updateQty($key['item']['id_product'], $updateQyt);
                unset($_SESSION['cart'][$key['item']['id_product']]);
            }
        }
        header('location: ' . BASEULR . '/transactions');
    }

    private function generateInvoice($qty)
    {
        $date = date('Y-m-d');
        return 'INV-' . str_replace('-', '', $date) . '-' . $qty;
    }

    private function getTotalCart()
    {
        $qty = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key) {
                $qty += $key['qty'];
            }
        }
        return $qty;
    }
}
