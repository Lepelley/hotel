<?php

namespace App\Database;

use MongoDB\Client;

class MongoDBConnection implements ConnectionInterface
{
    private $database;

    public function __construct()
    {
        $mongoDb = new Client(MONGODB_SERVER);
        $this->database = $mongoDb->selectDatabase(MONGODB_DBNAME);
    }

    public function get()
    {
        return $this->database;
    }
}
