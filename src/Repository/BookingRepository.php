<?php

namespace App\Repository;

use App\Database\RedisConnection;
use App\Entity\Booking;
use App\Session\PHPSession;

class BookingRepository
{
    private $database;
    private $prefix;

    public function __construct()
    {
        $this->database = (new RedisConnection())->get();
        $this->prefix = 'bookings_';
        $this->entity = Booking::class;
    }

    public function drop()
    {
        $keys = $this->database->keys($this->prefix . '*');
        foreach ($keys as $key) {
            $this->database->hdel($key, [
                'customerId',
                'lastName',
                'firstName',
                'title',
                'checkinDate',
                'checkoutDate',
                'adults',
                'children'
            ]);
        }
    }

    public function select(): array
    {
        $keys = $this->database->keys($this->prefix . '*');
        $bookings = [];
        foreach ($keys as $key => $value) {
            $bookings[$value] = new $this->entity($this->database->hgetall($value));
        }
        return $bookings;
    }

    public function selectOne($key)
    {
        return new $this->entity($this->database->hgetall($key));
    }

    public function add(array $data)
    {
        $key = uniqid($this->prefix);
        $customer = (new CustomerRepository())->selectOne(
            ['_id' => $data['customerId']]
        );

        $bookingData = [
            'customerId' => $data['customerId'],
            'lastName' => $customer->getLastName(),
            'firstName' => $customer->getFirstName(),
            'title' => $customer->getTitle(),
            'checkinDate' => $data['checkinDate'],
            'checkoutDate' => $data['checkoutDate'],
            'adults' => $data['adults'],
            'children' => $data['children']
        ];

        foreach ($bookingData as $index => $value) {
            $this->database->hset($key, $index, $value);
        }
    }

    public function delete($id)
    {
        $this->database->hdel($id, [
            'customerId',
            'lastName',
            'firstName',
            'title',
            'checkinDate',
            'checkoutDate',
            'adults',
            'children'
        ]);
    }

    public function update(array $data)
    {
        $key = $data['id'];
        unset($data['id']);

        $customer = (new CustomerRepository())->selectOne([
            '_id' => new \MongoDB\BSON\ObjectId($data['customerId'])
        ]);
        $data['firstName'] = $customer->getFirstName();
        $data['lastName'] = $customer->getLastName();
        $data['title'] = $customer->getTitle();

        foreach ($data as $index => $value) {
            $this->database->hset($key, $index, $value);
        }
    }

    public function isValid($data)
    {
        if (
            empty($data['customerId']) ||
            empty($data['checkinDate']) ||
            empty($data['checkoutDate']) ||
            empty($data['adults'])
        ) {
            return false;
        }

        if ($data['checkinDate'] > $data['checkoutDate']) {
            return false;
        }

        if ($data['adults'] < 1) {
            return false;
        }

        if ($data['children'] < 0) {
            return false;
        }

        return true;
    }
}
