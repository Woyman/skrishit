<?php

namespace App\Services;

use App\Repositories\KriteriaRepository;
use App\Repositories\HeroRepository;
use App\Utils\DateHelper;

class ElectreService
{
    private $kriteria_repo;
    private $hero_repo;

    public function __construct(KriteriaRepository $kriteria_repo,
                                HeroRepository $hero_repo)
    {
        $this->kriteria = $kriteria_repo;
        $this->hero = $hero_repo;
    }

    public function index($att)
    {                
        $alternatif = $this->getAllAlternatif();
        print_r($alternatif);
    }

    private function getAllAlternatif($filter = null)
    {
        $select = ['_id' => 1, 
                   'name' => 1,
                   'durability' => 1,
                   'offense' => 1,
                   'skill_effect' => 1,
                   'difficulty' => 1 
                ];    
        $alternatif = [];
        if($filter)
        {
            $alternatif = $this->hero->getAll($filter, $select);
        }else{
            $alternatif = $this->hero->getAll([], $select);
        }

        return $alternatif;
    }

    private function matrixR()
    {

    }
    
  

}
