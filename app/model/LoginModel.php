<?php

class LoginModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkLogin($data)
    {
        $username = $data['username'];
        $passwd = $data['passwd'];

        $sql = "SELECT * FROM tb_users AS usr
        WHERE usr.name = '$username' AND usr.password = '$passwd'";

        return $this->db->getAll($sql);
    }
}
