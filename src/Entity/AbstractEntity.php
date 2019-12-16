<?php

namespace App\Entity;

abstract class AbstractEntity
{
    public function __construct($data)
    {
        $this->hydrate($data);
    }

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
        }
    }
}
