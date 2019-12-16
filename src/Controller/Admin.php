<?php

namespace App\Controller;

use App\Session\PHPSession;

class Admin
{
    public function httpGetRequest()
    {
        $session = new PHPSession();
        $isLog = $session->isLog();
        $isAdmin = $session->isAdmin();
        if (!$isLog) {
            redirect_to_route('login');
        }
        if (!$isAdmin) {
            redirect_to_route('_default');
        }

        return ['isAdmin' => $isAdmin];
    }
}
