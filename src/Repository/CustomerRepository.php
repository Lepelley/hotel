<?php

namespace App\Repository;

use App\Entity\Customer;

class CustomerRepository extends AbstractMongoDBRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->database = ($this->connection)->selectCollection('customers');
        $this->entity = Customer::class;
    }

    public function findRandom()
    {
        $customers = $this->select();
        return array_rand($customers);
    }

    public function isValid($data)
    {
        if (
            empty($data['firstName']) ||
            empty($data['lastName']) ||
            empty($data['title']) ||
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['address']) ||
            empty($data['city']) ||
            empty($data['country']) ||
            empty($data['phone'])
        ) {
            return false;
        }

        return true;
    }
}
