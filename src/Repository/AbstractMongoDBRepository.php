<?php

namespace App\Repository;

use App\Database\MongoDBConnection;

abstract class AbstractMongoDBRepository implements RepositoryInterface
{
    protected $connection;
    protected $database;
    protected $entity;

    public function __construct()
    {
        $this->connection = (new MongoDBConnection())->get();
    }

    public function add(array $data)
    {
        $this->database->insertOne($data);
    }

    public function select($filter = [], $projection = [], $sort = [], $limit = 0)
    {
        $data = $this->database->find($filter, ['projection' => $projection,
            'sort' => $sort, 'limit' => $limit])->toArray();
        $elements = [];
        foreach ($data as $element) {
            $elements[] = new $this->entity((array) $element);
        }
        return $elements;
    }

    public function selectOne($filter = [], $projection = [], $sort = [])
    {
        $data = $this->database->findOne($filter);
        if (is_null($data)) {
            return null;
        }
        return new $this->entity((array) $data);
    }

    public function delete($id)
    {
        $id = new \MongoDB\BSON\ObjectId($id);
        $this->database->deleteOne(['_id' => $id]);
    }

    public function update(array $data)
    {
        $id = new \MongoDB\BSON\ObjectId($_POST['_id']);
        unset($_POST['_id']);
        $set = [];
        foreach ($_POST as $key => $value) {
            $set[$key] = $value;
        }
        $this->database->updateOne(['_id' => $id], ['$set' => $set]);
    }

    public function drop()
    {
        $this->database->drop();
    }

    abstract public function isValid($data);
}
