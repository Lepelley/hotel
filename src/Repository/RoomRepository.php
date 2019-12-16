<?php

namespace App\Repository;

use App\Entity\Room;
use MongoDB\BSON\ObjectId;

class RoomRepository extends AbstractMongoDBRepository
{

    public function __construct()
    {
        parent::__construct();
        $this->database = ($this->connection)->selectCollection('rooms');
        $this->entity = Room::class;
    }

    public function updateBooking(array $data)
    {
        $id = new ObjectId($_POST['room']);
        $room = $this->selectOne(['_id' => $id], ['bookings' => 1, '_id' => 0]);
        $customer = (new CustomerRepository())->selectOne(
            ['_id' => new ObjectId($data['customerId'])]
        );
        $bookings = $room->getBookings();
        $bookings[] = [
            'adults' => $data['adults'],
            'children' => $data['children'],
            'checkinDate' => $data['checkinDate'],
            'checkoutDate' => $data['checkoutDate'],
            'customer' => [
                '_id' => $customer->getId(),
                'firstName' => $customer->getFirstName(),
                'lastName' => $customer->getLastName(),
                'title' => $customer->getTitle(),
                'email' => $customer->getEmail(),
                'address' => $customer->getAddress(),
                'city' => $customer->getCity(),
                'country' => $customer->getCountry(),
                'phone' => $customer->getPhone(),
                'password' => $customer->getPassword()
            ]
        ];
        $this->database->updateOne(['_id' => $id], ['$set' => [
            'bookings' => $bookings
        ]]);
    }

    public function isValid($data)
    {
        if (
            empty($data['number']) ||
            empty($data['floor']) ||
            empty($data['type']) ||
            empty($data['beds']) ||
            empty($data['hasAirConditioner']) ||
            empty($data['hasTelevision']) ||
            empty($data['costPerNight'])
        ) {
            return false;
        }

        if ($data['number'] < 0) {
            return false;
        }

        $types = ['Simple', 'Double', 'Supérieur', 'Suite'];
        if (!in_array($data, $types)) {
            return false;
        }

        if ($data['beds'] < 1) {
            return false;
        }

        if ($data['hasTelevision'] < 0 || $data['hasTelevision'] > 1) {
            return false;
        }

        if ($data['hasAirConditioner'] < 0 || $data['hasAirConditioner'] > 1) {
            return false;
        }

        if ($data['costPerNight'] < 0) {
            return false;
        }

        return true;
    }
}
