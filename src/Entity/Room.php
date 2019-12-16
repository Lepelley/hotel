<?php

namespace App\Entity;

class Room extends AbstractEntity
{
    private $id;
    private $number;
    private $floor;
    private $type;
    private $beds;
    private $hasAirConditioner;
    private $hasTelevision;
    private $costPerNight;
    private $bookings;

    /**
     * Hydrate Room object
     * @param  mixed[] $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
            if ($key == '_id') {
                $this->setId($value);
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getBeds()
    {
        return $this->beds;
    }

    public function getHasAirConditioner()
    {
        return $this->hasAirConditioner;
    }

    public function getHasTelevision()
    {
        return $this->hasTelevision;
    }

    public function getCostPerNight()
    {
        return $this->costPerNight;
    }

    public function getBookings()
    {
        return $this->bookings;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setBeds($beds)
    {
        $this->beds = $beds;
    }

    public function setHasAirConditioner($hasAirConditioner)
    {
        $this->hasAirConditioner = $hasAirConditioner;
    }

    public function setHasTelevision($hasTelevision)
    {
        $this->hasTelevision = $hasTelevision;
    }

    public function setCostPerNight($costPerNight)
    {
        $this->costPerNight = $costPerNight;
    }

    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
    }
}
