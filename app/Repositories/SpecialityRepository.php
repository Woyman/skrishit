<?php

namespace App\Repositories;

use App\Speciality;
use App\Repositories\GlobalRepository;

class SpecialityRepository extends GlobalRepository
{
    private $model;
    /**
     * SpecialityRepository constructor.
     * @param $model
     */
    public function __construct(Speciality $model)
    {
        $this->_collection = $model;        
    }        

}
