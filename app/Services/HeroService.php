<?php

namespace App\Services;

use App\Repositories\HeroRepository;
use App\Utils\DateHelper;

class HeroService
{
    private $repo;

    public function __construct(HeroRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {          
        $heros = $this->repo->getAll();
        
        foreach($heros as &$hero )
        {
            $role = (array) $hero['role'];
            $speciality = (array) $hero['speciality'];
            $hero['role'] = implode(', ', $role);
            $hero['speciality'] = implode(', ', $speciality);
        }
        
        return $heros;
    }

    public function getOne($idRole)
    {
        $filter = ['_id' => $idRole ];
        return $this->repo->getOne($filter);
    }

    public function insert($att)
    {
        $insert = $this->repo->save($att);
        return $insert;
    }

    public function update($att)
    {
        $update = $this->repo->save($att);
        return $update;
    }

    public function delete($idRole)
    {
        $delete = $this->repo->delete($idRole);
        // print_r($delete);
        return 'Role berhasil dihapus';
    }
  

}
