<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Session\PHPSession;

class BookingAdd
{
    private $session;

    public function __construct()
    {
        $this->session = new PHPSession();
        $isLog = $this->session->isLog();
        if (!$isLog) {
            redirect_to_route('login');
        }
    }

    public function httpGetRequest()
    {
        return [
            'isLog' => $this->session->isLog(),
            'isAdmin' => $this->session->isAdmin()
        ];
    }

    public function httpPostRequest()
    {
        if (isset($_POST)) {
            $bookingRepository = new BookingRepository();
            $_POST['customerId'] = $this->session->get('login_id');
            if ($bookingRepository->isValid($_POST)) {
                $bookingRepository->add($_POST);
                redirect_to_route('_default');
            }
        }

        redirect_to_route('booking/add');
    }
}
