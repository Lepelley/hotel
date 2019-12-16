<?php

namespace App\Database;

use Predis\Client;

class RedisConnection implements ConnectionInterface
{
    private $database;

    public function __construct()
    {
        $options = ['parameters' => ['password' => REDIS_PASSWORD]];
        $this->database = new Client(REDIS_ENDPOINT, $options);
    }

    public function get()
    {
        return $this->database;
    }
}
