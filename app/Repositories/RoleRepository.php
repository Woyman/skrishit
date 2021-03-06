<?php

namespace App\Repositories;

use App\Role;
use App\Repositories\GlobalRepository;

class RoleRepository extends GlobalRepository
{
    private $model;
    /**
     * RoleRepository constructor.
     * @param $model
     */
    public function __construct(Role $model)
    {
        $this->_collection = $model;        
    }        

}
