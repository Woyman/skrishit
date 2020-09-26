<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Utils\DateHelper;

class RoleService
{
    private $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {                
        return $this->repo->getAll();
    }

    public function insert($att)
    {
        $insert = $this->repo->save($att);

        return $insert;
    }
  

}
