<?php

class Home extends Controller
{

    public function __construct()
    {
        Service::checkLogin();
    }

    public function index()
    {
        $data['title'] = 'Page Home';

        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
