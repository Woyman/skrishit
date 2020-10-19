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

    public function updateRole($roleOld, $newRole = null)
    {
        $filter = ['role' => $roleOld ];
        if($newRole)
        {
            $update = ['$set' => ['role.$' => $newRole] ];
        }else{
            $update = ['$pull' => ['role' => $roleOld  ] ];
        }
      
        $updateMany = $this->_collection->raw()->updateMany($filter, $update);        
        return $updateMany;
    }

    public function updateSpeciality($oldSpeciality, $newSpeciality = null)
    {
        $filter = ['speciality' => $oldSpeciality ];
        if($newSpeciality)
        {
            $update = ['$set' => ['speciality.$' => $newSpeciality] ];
        }else{
            $update = ['$pull' => ['speciality' => $oldSpeciality] ];
        }
      
        $updateMany = $this->_collection->raw()->updateMany($filter, $update);           
        return $updateMany;
    }

}
