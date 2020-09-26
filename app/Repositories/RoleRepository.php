<?php

namespace App\Repositories;

use App\Role;
use App\Repositories\GlobalRepository;

class RoleRepository extends GlobalRepository
{
    private $role;
    /**
     * RoleRepository constructor.
     * @param Role $order
     */
    public function __construct(Role $role)
    {
        $this->_collection = $role;        
    }        

}
