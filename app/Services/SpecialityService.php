<?php

namespace App\Services;

use App\Repositories\SpecialityRepository;
use App\Repositories\HeroRepository;
use App\Utils\DateHelper;

class SpecialityService
{
    private $repo;
    private $hero_repo;

    public function __construct(SpecialityRepository $repo, 
                                HeroRepository $hero_repo)
    {
        $this->repo = $repo;
        $this->hero = $hero_repo;
    }

    public function getAll()
    {                
        return $this->repo->getAll();
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
        $oldSpeciality = $this->getOne($att['_id']);
        
        // print_r($att);
        // print_r($oldSpeciality);
        $this->hero->updateSpeciality($oldSpeciality['speciality_name'], $att['speciality_name']);
        $update = $this->repo->save($att);
        return $update;
    }

    public function delete($idRole)
    {
        $oldSpeciality = $this->getOne($idRole);
        $delete = $this->repo->delete($idRole);

        $this->hero->updateSpeciality($oldSpeciality['speciality_name']);
        // print_r($delete);
        return 'Speciality berhasil dihapus';
    }
  

}
