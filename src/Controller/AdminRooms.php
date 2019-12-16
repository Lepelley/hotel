<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use App\Session\PHPSession;

class AdminRooms
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

        return [
            'rooms' => (new RoomRepository())->select(),
            'isAdmin' => $isAdmin
        ];
    }
}
