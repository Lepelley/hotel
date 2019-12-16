<?php

namespace App\Repository;

interface RepositoryInterface
{
    // CRUD
    public function add(array $data);
    public function select($filter = [], $projection = [], $sort = [], $limit = 0);
    public function update(array $data);
    public function delete($id);
    
    public function drop();
    public function isValid($data);
}
