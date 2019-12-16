<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Session\PHPSession;

class AdminCustomers
{
    public function httpGetRequest()
    {
        $session = new PHPSession();
        if (!$session->isLog()) {
            \redirect_to_route('login');
        }
        $isAdmin = $session->isAdmin();
        if (!$isAdmin) {
            \redirect_to_route('_default');
        }

        return [
            'customers' => (new CustomerRepository())->select(),
            'isAdmin' => $isAdmin
        ];
    }
}
