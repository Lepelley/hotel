<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\CustomerRepository;
use App\Repository\RoomRepository;
use App\Session\PHPSession;

class BookingCheck
{
    private $bookingRepository;
    private $roomRepository;
    private $session;
    
    public function __construct()
    {
        $this->session = new PHPSession();
        $this->bookingRepository = new BookingRepository();
        $this->roomRepository = new RoomRepository();
        if (!$this->session->isLog()) {
            \redirect_to_route('login');
        }
        if (!$this->session->isAdmin()) {
            \redirect_to_route('_default');
        }
    }
    
    public function httpGetRequest()
    {
        if (isset($_GET['id'])) {
            $booking = $this->bookingRepository->selectOne($_GET['id']);
            if ($booking->getCustomerId() == '') {
                \redirect_to_route('admin/bookings');
            }
        }

        return [
            'booking'   => $booking,
            'customers' => (new CustomerRepository())->select(),
            'rooms'     => $this->roomRepository->select(),
            'isAdmin'   => $this->session->isAdmin()
        ];
    }

    public function httpPostRequest()
    {
        if ($this->bookingRepository->isValid($_POST)) {
            $this->roomRepository->updateBooking($_POST);
            $this->bookingRepository->delete($_GET['id']);
            \redirect_to_route('admin/bookings');
        }
        \redirect_to_route('admin/booking/check?id=' . $_GET['id']);
    }
}
