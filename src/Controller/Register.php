<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Session\PHPSession;

class Register
{
    private $session;

    public function __construct()
    {
        $this->session = new PHPSession();
        $isLog = $this->session->isLog();
        if ($isLog) {
            \redirect_to_route('_default');
        }
    }

    public function httpGetRequest()
    {
    }

    public function httpPostRequest()
    {
        $customerRepository = new CustomerRepository();
        if ($customerRepository->isValid($_POST)) {
            $_POST['password'] = \password_hash($_POST['password'], PASSWORD_DEFAULT);
            $customerRepository->add($_POST);
            \redirect_to_route('login');
        }
        
        redirect_to_route('register');
    }
}
