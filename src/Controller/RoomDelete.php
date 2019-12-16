<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use App\Session\PHPSession;

class RoomDelete
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
            (new RoomRepository())->delete($_GET['id']);
        }
        
        \redirect_to_route('admin/rooms');
    }
}
