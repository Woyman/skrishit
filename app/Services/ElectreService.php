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
        
        $matrix_R = $this->matrixR($matrix_X, $bobot);
        $matrix_V = $this->matrixV($matrix_R, $bobot);
        $cd_dd = $this->CD_DD($matrix_V, $bobot);

        $electre['bobot_preferensi'] = $bobot;
        $electre['matrix_X'] = $matrix_X;
        $electre['matrix_R'] = $matrix_R;
        $electre['matrix_V'] = $matrix_V;
        $electre['CD_DD'] = $cd_dd;
        
        // print_r($electre);
        // return $electre;
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

    private function matrixV($matrix_R, $bobot)
    {        
        foreach($bobot as $index => $b)
        {
            foreach($matrix_R as $idx_matrix => &$matrix)
            {
                $matrix['nilai'][$index] = $matrix['nilai'][$index]*$b['nilai'];
            }    
        }
                
        return $matrix_R;
    }

    private function CD_DD($matrix_V, $bobot)
    {
        print_r($bobot);
        // print_r($matrix_V);
        $jmlAlt = count($matrix_V);
        $CD_DD = [];

        foreach($matrix_V as $index => $alt)
        {
            for($i = 0; $i<$jmlAlt; $i++)
            {
                if($i != $index)
                {
                    $cd = [];
                    $dd = [];

                    foreach($bobot as $idx_k => $kriteria)
                    {
                        $nilaiAlt = $alt['nilai'][$idx_k];
                        $nilaiAlt2 = $matrix_V[$i]['nilai'][$idx_k];

                        if($nilaiAlt >= $nilaiAlt2)
                        {
                            $cd[] = $idx_k;
                        }else{
                            $dd[] = $idx_k;
                        }
                    }

                    $CD_DD[$index][$i]['cd'] = $cd;
                    $CD_DD[$index][$i]['dd'] = $dd;
                }
                else
                {
                    $CD_DD[$index][$i] = 0;
                }
            }
        }        

        // hitung Concordance
        foreach($CD_DD as $index=> &$arrayCd )
        {                   
            foreach($arrayCd as $idx_cd => &$array )
            {                                                
                if(is_array($array))
                {
                    $nilaiCD = 0;
                    foreach($array['cd'] as $cd )
                    {                        
                        $nilaiCD = $nilaiCD + $bobot[$cd]['nilai'];
                    }
                    $array['nilaiCD'] = $nilaiCD;
                }

            }   
                                   
        }        

        //hitung diconcordance
        foreach($CD_DD as $index=> &$arrayCd )
        {   
            foreach($arrayCd as $idx_cd => &$array )
            {
                if(is_array($array))
                {
                    $array_atas = [];
                    foreach($array['dd'] as $dd )
                    {
                        $array_atas[] = abs($matrix_V[$index]['nilai'][$dd] - $matrix_V[$idx_cd]['nilai'][$dd]);
                    }

                    $array_bawah = [];
                    foreach($matrix_V[$index]['nilai'] as $idx_alt => $value )
                    {
                        $array_bawah[] = abs($matrix_V[$index]['nilai'][$idx_alt] - $matrix_V[$idx_cd]['nilai'][$idx_alt]);
                    }
                                        
                    if(empty($array_atas))  $array_atas = array(0);
                    if(empty($array_bawah))  $array_bawah = array(0);

                    // print_r($array_atas);                    
                    // print_r($array_bawah);
                    $array['nilaiDD'] = round(max($array_atas) / max($array_bawah), 4);
                }        
                           
            }
        }

        print_r($CD_DD);
        return $CD_DD;
    }
    
  

}
