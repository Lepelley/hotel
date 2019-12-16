<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Session\PHPSession;

class CustomerUpdate
{
    private $customerRepository;
    private $session;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
        $this->session = new PHPSession();
        $isLog = $this->session->isLog();
        $isAdmin = $this->session->isAdmin();
        if (!$isLog) {
            \redirect_to_route('login');
        }
        if (!$isAdmin) {
            \redirect_to_route('_default');
        }
    }
    
    public function httpGetRequest()
    {
        if (isset($_GET['id'])) {
            $update = new \MongoDB\BSON\ObjectId($_GET['id']);
            $customer = $this->customerRepository->selectOne(
                ['_id' => $update]
            );
            if ($customer->getId() == '') {
                \redirect_to_route('admin/customers');
            }
        }
        return [
            'customer' => $customer,
            'isAdmin' => $this->session->isAdmin()
        ];
    }

    public function httpPostRequest()
    {
        if ($this->customerRepository->isValid($_POST)) {
            $this->customerRepository->update($_POST);
        }

        \redirect_to_route('admin/customers');
    }
}
