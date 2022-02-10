<?php

class Home extends Controller
{

    public function __construct()
    {
        if (($_SESSION['session_login'] != 'Login')) {
            header('location: ' . BASEULR . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Page Home';

        $this->view('templates/header');
        $this->view('home/index');
    }
}
