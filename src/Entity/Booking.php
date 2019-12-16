<?php

namespace App\Entity;

class Booking extends AbstractEntity
{
    private $id;
    private $customerId;
    private $lastName;
    private $firstName;
    private $title;
    private $checkinDate;
    private $checkoutDate;
    private $adults;
    private $children;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCheckinDate()
    {
        return $this->checkinDate;
    }

    public function setCheckinDate($checkinDate)
    {
        $this->checkinDate = $checkinDate;
    }

    public function getCheckoutDate()
    {
        return $this->checkoutDate;
    }

    public function setCheckoutDate($checkoutDate)
    {
        $this->checkoutDate = $checkoutDate;
    }

    public function getAdults()
    {
        return $this->adults;
    }

    public function setAdults($adults)
    {
        $this->adults = $adults;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }
}
