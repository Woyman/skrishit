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
        $dominan_CCDD = $this->dominan_CDDD($cd_dd, count($matrix_X));
        $aggregate_dominan = $this->aggregate_dominan($dominan_CCDD['dominan_CDDD']);
        $ranking = $this->ranking($aggregate_dominan, $matrix_X);

        $electre['bobot_preferensi'] = $bobot;
        $electre['matrix_X'] = $matrix_X;
        $electre['matrix_R'] = $matrix_R;
        $electre['matrix_V'] = $matrix_V;
        $electre['CD_DD'] = $cd_dd;
        $electre['dominan_CDDD'] = $dominan_CCDD;
        $electre['aggregate_dominan'] = $aggregate_dominan;
        $electre['ranking'] = $ranking;
        
        // print_r($electre);
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
                                                            
                    if(max($array_atas) == 0 && max($array_bawah) == 0)
                    {
                        $array['nilaiDD'] = 0;
                    }else{
                        $array['nilaiDD'] = round(max($array_atas) / max($array_bawah), 4);
                    }
                                        
                }        
                            
            }
        }
        // print_r($CD_DD);
        return $CD_DD;
    }

    private function dominan_CDDD($CD_DD, $m)
    {        
        
        $totalCD = 0;
        $totalDD = 0;

        foreach($CD_DD as $index=>$row)
        {
            foreach($row as $idx_row=> $cd_dd)
            {
                if(is_array($cd_dd))
                {                    
                    $totalCD = $totalCD + $cd_dd['nilaiCD'];
                    $totalDD = $totalDD + $cd_dd['nilaiDD'];
                }
            }
            
        }                

        $thresholdCD = $totalCD/($m*($m-1));
        $thresholdDD = $totalDD/($m*($m-1));

        // echo "threshold CD = ".$thresholdCD;
        // echo " - threshold DD = ".$thresholdDD;

        foreach($CD_DD as $index=> &$row)
        {
            foreach($row as $idx_row=> &$cd_dd)
            {
                if(is_array($cd_dd))
                {                    
                        
                    $cd_dd['nilaiDD'];

                    if($cd_dd['nilaiCD'] >= $thresholdCD){ 
                            $cd_dd['d_cd'] = 1; 
                    }else{ 
                        $cd_dd['d_cd'] = 0; 
                    }

                    if($cd_dd['nilaiDD'] >= $thresholdDD){ 
                        $cd_dd['d_dd'] = 0; 
                    }else{ 
                        $cd_dd['d_dd'] = 1; 
                    }
                    unset($cd_dd['cd']);
                    unset($cd_dd['dd']);
                    unset($cd_dd['nilaiCD']);
                    unset($cd_dd['nilaiDD']);
                }                
            }            
        }        
        $result['dominan_CDDD'] = $CD_DD;
        $result['thresholdCD'] = $thresholdCD;
        $result['thresholdDD'] = $thresholdDD;
        return $result;
    }
    
    private function aggregate_dominan($dominan)
    {        
        $aggregate = [];
        
        foreach($dominan as $idx_row=> $row)
        {
            foreach($row as $idx => $dm )
            {
                if(is_array($dm))
                {
                    $aggregate[$idx_row][$idx] = $dm['d_cd'] * $dm['d_dd'];
                }else{
                    $aggregate[$idx_row][$idx] = '-';
                }
                
            }
        }        

        return $aggregate;
    }

private function ranking($aggregate, $alternatif)
{
    // print_r($alternatif);
    $result = [];
    foreach($aggregate as $idx_row=>&$row)
    {          
        $totalAggregate = 0;  
        foreach($row as $index=>$ag)
        {
            if(is_integer($ag))
            {
                $totalAggregate = $totalAggregate + $ag;
            }                
        }
        if($totalAggregate > 0 )
        {
            $result[$idx_row]['id_hero'] = $alternatif[$idx_row]['data']['id'];
            $result[$idx_row]['hero_name'] = $alternatif[$idx_row]['data']['nama'];
            $result[$idx_row]['total'] = $totalAggregate;            
        }            
    }

    $total = array();
    foreach ($result as $key => $row)
    {
        $total[$key] = $row['total'];
    }
    array_multisort($total, SORT_DESC, $result);

    // print_r($result);
    return $result;
}

    
}
