<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\AbstractRepository;

interface SpesicalRepository extends AbstractRepository
{

    public function find($id, $select = ['*'], $with = []);

    public function getAllUser($paginate);
    
    public function getAll($status);

    public function updateSpecial($id, $data = []);

     public function getAllOrderBy($id, $status);

}
