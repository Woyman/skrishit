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
        $bobot = $att['bobot_preferensi'];
        $matrix_X = $att['matrix_X'];
        // print_r($matrix_X);        
        $matrix_R = $this->matrixR($matrix_X, $bobot);

        $electre['matrix_R'] = $matrix_R;
        
        return $electre;
    }

    public function getmatrixX($att)
    {                
        $filter = [];
        if(isset($att['role']) )
        {
            $filter['role'] =  ['$in' => $att['role']] ;

            if(count($att['role']) == 0 ){ unset($filter['role']); }
            unset($att['role']);
        }
        if(isset($att['speciality']) )
        {
            $filter['speciality'] =  ['$in' => $att['speciality']] ;

            if(count($att['speciality']) == 0 ){ unset($filter['speciality']); }
            unset($att['speciality']);
        }

        // print_r($filter);
        $alternatif = $this->getAllAlternatif($filter);
        $matrixX = $this->matrixX($alternatif, $att);        

        $result['bobot_preferensi'] = $matrixX['bobot_preferensi'];
        if( isset($matrixX['data']) )
        {
            $result['matrix_X'] = $matrixX['data'];
        }else{
            $result['matrix_X'] = [];
        }
        
        
        return $result;
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
        foreach($alternatif as &$alt )
        {
            $alt = (array) $alt;
        }

        return $alternatif;
    }

    private function matrixX($alternatif, $att)
    {                
        $matrix = [];

        // mengurutkan kriteria
        foreach($att as $indexAtt=>$att)
        {
            $filter = ['kriteria_field' => $indexAtt ];
            $kriteria = $this->kriteria->getOne($filter);
            $kriteria = (array) $kriteria;
            
            $bobot = [
                'field' => $kriteria['kriteria_field'],
                'label' => $kriteria['kriteria_name'],
                'nilai' => $att
            ];

            $matrix['bobot_preferensi'][] = $bobot;
        }
        
        //ambil kriteria sesuai urutan untuk menjadi matrix
        $bobot_preferensi = $matrix['bobot_preferensi'];
        foreach($alternatif as $index => $alt)
        {   
            $data = ['id' => $alt['_id'], 'nama' => $alt['name'] ];            
            $matrix['data'][$index]['data'] = $data;

            foreach($bobot_preferensi as $indexBbt=>$bp )
            {
                $kriteria = $bp['field'];
                $matrix['data'][$index]['nilai'][$indexBbt] = $alt[$kriteria];
            }

        }        
        
        return $matrix;
    }

    private function matrixR($matrix_X, $bobot)
    {
        $x = [];        
        
        foreach($bobot as $index=>$k)
        {
            $x[$index] = 0;

            foreach($matrix_X as &$alt)
            {
                $x[$index] += pow($alt['nilai'][$index], 2);                
            }   
            $x[$index] = sqrt($x[$index]);

            foreach($matrix_X as &$alt)
            {
                $alt['nilai'][$index] = ($alt['nilai'][$index]/$x[$index]);
            }              
        }
        
        return $matrix_X;
    }
    
  

}
