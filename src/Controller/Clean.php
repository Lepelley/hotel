<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\CustomerRepository;
use App\Repository\RoomRepository;
use Faker\Factory;

class Clean
{
    public function httpGetRequest()
    {
        $faker = Factory::create('fr_FR');

        $bookingsDatabase = new BookingRepository();
        $bookingsDatabase->drop();

        $customersDatabase = new CustomerRepository();
        $customersDatabase->drop();

        $title = ['F', 'M'];

        for ($i = 1; $i <= 40; $i++) {
            $titleRand = array_rand($title);

            if ($titleRand == 'F') {
                $firstName = $faker->firstNameFemale;
            } else {
                $firstName = $faker->firstNameMale;
            }
            $lastName = $faker->lastName;
            $email = "$firstName.$lastName@gmail.com";

            $customersDatabase->add([
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'title'     => $title[$titleRand],
                'email'     => $email,
                'password'  => $faker->password(),
                'address'   => $faker->streetAddress,
                'city'      => $faker->city,
                'country'   => $faker->country,
                'phone'     => $faker->phoneNumber
            ]);
        }

        $roomsDatabase = new RoomRepository();
        $roomsDatabase->drop();

        $roomsType = ['Simple', 'Double', 'Supérieur', 'Suite'];
        for ($i = 1; $i <= 20; $i++) {
            $floor = rand(1, 10);
            $type = $roomsType[array_rand($roomsType)];
            $isBooking = rand(0, 1);
            $bookings = [];
            if ($isBooking) {
                $dateIn = $faker->date;
                $dateOut = $faker->date;
                if ($dateIn > $dateOut) {
                    $tmp = $dateIn;
                    $dateIn = $dateOut;
                    $dateOut = $tmp;
                }
                $bookings[] = [
                    'checkinDate' => $dateIn,
                    'checkoutDate' => $dateOut,
                    'adults' => rand(1, 4),
                    'children' => rand(0, 4),
                    'customer' => [0 => [
                        $customersDatabase->findRandom()
                    ]]
                ];
            }
            $roomToAdd = [
                'number' => $floor * 100 + rand(1, 30),
                'floor' => $floor,
                'type' => $type,
                'beds' => rand(1, 4),
                'hasAirConditioner' => rand(0, 1),
                'hasTelevision' => rand(0, 1),
                'bookings' => $bookings
            ];
            $roomToAdd['costPerNight'] = $this->getPrice($roomToAdd);
            $roomsDatabase->add($roomToAdd);
        }

        return [
            'customers' => $customersDatabase->select(),
            'rooms' => $roomsDatabase->select()
        ];
    }

    private function getPrice(array $data): int
    {
        $roomsType = ['Simple', 'Double', 'Supérieur', 'Suite'];

        $price = 80;

        $price += $data['hasTelevision'] * 20;
        $price += $data['hasAirConditioner'] * 20;
        $price += $data['beds'] * 20;

        switch ($data['type']) {
            case $roomsType[0]:
                $price += 5;
                break;
            case $roomsType[1]:
                $price += 25;
                break;
            case $roomsType[2]:
                $price += 45;
                break;
            case $roomsType[3]:
                $price += 85;
                break;
        }

        return $price;
    }
}
