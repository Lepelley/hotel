<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use App\Session\PHPSession;

class RoomUpdate
{
    private $roomRepository;
    private $session;

    public function __construct()
    {
        $this->roomRepository = new RoomRepository();
        $this->session = new PHPSession();
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
            $update = new \MongoDB\BSON\ObjectId($_GET['id']);
            $room = $this->roomRepository->selectOne(['_id' => $update]);

            if (is_null($room)) {
                \redirect_to_route('admin/rooms');
            }
        }

        return [
            'room' => $room,
            'isAdmin' => $this->session->isAdmin()
        ];
    }

    public function httpPostRequest()
    {
        if ($this->roomRepository->isValid($_POST)) {
            $this->roomRepository->update($_POST);
        }

        \redirect_to_route('admin/rooms');
    }
}
