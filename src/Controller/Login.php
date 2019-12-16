<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Session\PHPSession;

class Login
{
    private $session;

    public function __construct()
    {
        $this->session = new PHPSession();
    }

    public function httpGetRequest()
    {
        $isLog = $this->session->isLog();
        if ($isLog) {
            $this->session->delete('login_id');
            $this->session->delete('email');
            $this->session->delete('password');
            \redirect_to_route('_default');
        }
    }

    public function httpPostRequest()
    {
        $customer = (new CustomerRepository())->selectOne([
            'email' => $_POST['email']
        ]);

        if (\password_verify($_POST['password'], $customer->getPassword())) {
            $this->session->set(
                'login_id',
                $customer->getId()
            );
            $this->session->set(
                'email',
                $customer->getEmail()
            );
            $this->session->set(
                'password',
                $customer->getPassword()
            );
            \redirect_to_route('_default');
        }

        \redirect_to_route('login');
    }
}
