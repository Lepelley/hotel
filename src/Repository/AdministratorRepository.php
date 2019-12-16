<?php

namespace App\Repository;

use App\Database\MongoDBConnection;

class AdministratorRepository
{

    public function __construct()
    {
        $this->connection = (new MongoDBConnection())->get();
        $this->database = ($this->connection)->selectCollection('administrators');
    }

    public function add(string $email)
    {
        $this->database->insertOne(['email' => $email]);
    }

    public function select($filter)
    {
        return $this->database->find($filter)->toArray();
    }
}
