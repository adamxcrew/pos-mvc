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

    public function cartItem($data)
    { }
}
