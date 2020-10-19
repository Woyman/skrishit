<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\HeroRepository;
use App\Utils\DateHelper;

class RoleService
{
    private $repo;
    private $hero_repo;

    public function __construct(RoleRepository $repo,
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
        $oldRole = $this->getOne($att['_id']);
        $update = $this->repo->save($att);                

        $this->hero->updateRole($oldRole['role_name'], $att['role_name']);
        return $update;
    }

    public function delete($idRole)
    {
        $oldRole = $this->getOne($idRole);
        $delete = $this->repo->delete($idRole);

        $this->hero->updateRole($oldRole['role_name']);
        // print_r($delete);
        return 'Role berhasil dihapus';
    }
  

}
