<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Session\PHPSession;

class AdminBookings
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

        return [
            'bookings' => (new BookingRepository())->select(),
            'isAdmin' => $isAdmin
        ];
    }
}
