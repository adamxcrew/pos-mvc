<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;


    public function __construct()
    {
        $host = $this->host;
        $user = $this->user;
        $password = $this->pass;
        $dbname = $this->db_name;
        return $this->conn = mysqli_connect($host, $user, $password, $dbname);
    }

    public function getAll($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        }
    }

    public function getData($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function getItemByID($id)
    {
        $sql = "SELECT * FROM tb_kategori WHERE idkategori=$id";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getItem($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function rowCount($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function runSQL($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}
