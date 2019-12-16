<?php

namespace App\Entity;

class Customer extends AbstractEntity
{
    private $id;

    private $firstName;

    private $lastName;

    private $title;

    private $email;

    private $password;

    private $address;

    private $city;

    private $country;

    private $phone;

    /**
     * Hydrate Customer object
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstName(?string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(?string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    public function setPassword(?string $password)
    {
        $this->password = $password;
    }

    public function setAddress(?string $address)
    {
        $this->address = $address;
    }

    public function setCity(?string $city)
    {
        $this->city = $city;
    }

    public function setCountry(?string $country)
    {
        $this->country = $country;
    }

    public function setPhone(?string $phone)
    {
        $this->phone = $phone;
    }
}
