<?php

namespace App\Services;

use App\Repositories\KriteriaRepository;
use App\Utils\DateHelper;

class KriteriaService
{
    private $repo;

    public function __construct(KriteriaRepository $repo)
    {
        $this->repo = $repo;
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
