<?php

namespace App\Repositories;

use App\Hero;
use App\Repositories\GlobalRepository;

class HeroRepository extends GlobalRepository
{
    private $model;
    /**
     * RoleRepository constructor.
     * @param $model
     */
    public function __construct(Hero $model)
    {
        $this->_collection = $model;        
    }        

}
