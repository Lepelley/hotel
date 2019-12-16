<?php

namespace App\Controller;

use App\Session\PHPSession;

class Home
{
    public function httpGetRequest()
    {
        $session = new PHPSession();
        return [
            'isLog'   => $session->isLog(),
            'isAdmin' => $session->isAdmin()
        ];
    }
}
