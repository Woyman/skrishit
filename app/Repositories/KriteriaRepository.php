<?php

namespace App\Repositories;

use App\Kriteria;
use App\Repositories\GlobalRepository;

class KriteriaRepository extends GlobalRepository
{
    private $model;
    /**
     * RoleRepository constructor.
     * @param $model
     */
    public function __construct(Kriteria $model)
    {
        $this->_collection = $model;        
    }        

}
