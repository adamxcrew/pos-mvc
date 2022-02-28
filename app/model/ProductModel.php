<?php

class ProductModel
{
    private $table = 'tb_product';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM " . $this->table;
        return $this->db->getAll($sql);
    }

    public function addDataProduct($data)
    {
        $extension = array('png', 'jpg');
        $productname = $data['productname'];
        $image = $_FILES['productimage']['name'];
        $desc = $data['description'];
        $qty = $data['quantity'];
        $price = $data['price'];
        $date = date('Y-m-d');

        $temp = $_FILES['productimage']['tmp_name'];
        $target_dir = 'upload/' . $image;
        $ext = pathinfo($image, PATHINFO_EXTENSION);

        if (empty($image)) {
            echo "Image must be filled";
        } else if (!in_array($ext, $extension)) {
            echo "File must be of type png or jpg";
        } else {
            if (file_exists($target_dir)) {
                echo "Sorry, image file already exist";
            } else {
                $sql = "INSERT INTO tb_product VALUES('','$productname','$image','$desc',$qty,$price,'$date')";
                if ($sql) {
                    move_uploaded_file($temp, "uploads/" . $image);
                    return $this->db->runSQL($sql);
                }
            }
        }
    }

    public function getItemById($id)
    {
        $sql = "SELECT p.idproduct, p.name, p.price, p.quantity FROM tb_product AS p WHERE p.idproduct = '$id'";
        return $this->db->getItemByID($sql);
    }

    public function search($search)
    {
        $sql = "SELECT * FROM tb_product AS p WHERE p.name LIKE '%" . $search . "%'";
        return $this->db->getAll($sql);
    }

    public function updateQty($id, $qty)
    {
        try {
            //code...
            $sql = "UPDATE tb_product SET quantity = $qty WHERE idproduct= '$id'";
            return $this->db->runSQL($sql);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function transaction($iduser, $payment, $total)
    {
        $Id = 1;
        $invoe = 'T' . date('y') . date('m') . str_pad($Id, 3, '0', STR_PAD_LEFT);
        $date = date('Y-m-d');
        $sql = "INSERT INTO tb_transaction VALUES ('$invoe', $iduser, $payment, $total, '$date')";
        return $this->db->runSQL($sql);
    }
}
