<?php

class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Page Home';

        $this->view('templates/header');
        $this->view('home/index');
    }
}
