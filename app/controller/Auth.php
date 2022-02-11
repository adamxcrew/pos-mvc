<?php

class Auth extends Controller
{
    public function index()
    {
        $this->view('home/login');
    }

    public function LoginProccess()
    {

        $row = $this->model('LoginModel')->checkLogin($_POST) > 0;
        if ($row == true) {
            $data = $this->model('LoginModel')->checkLogin($_POST);
            $_SESSION['session_login'] = 'Login';
            $_SESSION['username'] = $data[0]['name'];
            header('location: ' . BASEULR . '/home');
            exit;
        } else {
            Flasher::setMessage('Username/Password', 'Wrong', 'danger');
            // var_dump(Flasher::setMessage('Username or Password', 'wrong', 'danger'));
            header('location: ' . BASEULR . '/login');
            exit;
        }
    }

    public function Logout()
    {
        session_start();
        session_destroy();
        header('location: ' . BASEULR . '/login');
    }
}
