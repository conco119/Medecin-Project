<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\AbstractRepository;

interface UserRepository extends AbstractRepository
{

    public function create($data = []);

    public function find($id, $select = ['*'], $with = []);

    public function findByPhone($phone);

    public function getAllUser($permissionadmin, $permissiondoctor, $permissiondisable, $paginate);
    
    public function getAllUserNew();
    
    public function searchUser($keyword, $with = [], $select = ['*']);

     public function getByPermission($permission, $with = [], $select = ['*']);
}
