<?php

class Service
{

    public static function show($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }


    static function checkLogin()
    {
        if (($_SESSION['session_login'] != 'Login')) {
            header('location: ' . BASEULR . '/auth');
            exit;
        }
    }
}
