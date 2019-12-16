<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Session\PHPSession;

class CustomerDelete
{
    public function httpGetRequest()
    {
        $session = new PHPSession();
        $isLog = $session->isLog();
        $isAdmin = $session->isAdmin();
        if (!$isLog) {
            \redirect_to_route('login');
        }
        if (!$isAdmin) {
            \redirect_to_route('_default');
        }

        if (isset($_GET['id'])) {
            (new CustomerRepository())->delete($_GET['id']);
        }

        \redirect_to_route('admin/customers');
    }
}
