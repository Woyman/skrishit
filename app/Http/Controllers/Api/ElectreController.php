<?php

namespace App\Http\Controllers\Api;

use App\Services\ElectreService;
use App\Services\KriteriaService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class ElectreController 
{
    private $service;
    /**
     * RoleController constructor.
     * @param $service
     */
    public function __construct(ElectreService $service,
                                KriteriaService $kriteria )
    {
        $this->service = $service;
        $this->kriteria = $kriteria;
    }

    public function index(Request $req)
    {
        $allKriteria = $this->kriteria->getAll();
        $validate = [];
        foreach($allKriteria as $kriteria)
        {
            $validate[$kriteria['kriteria_field']] = 'required|numeric';
        }
        
        $validate['role'] = 'array';
        $validate['speciality'] = 'array';

        $att = $req->validate($validate);
        // print_r($req->all());

        $data = $this->service->getmatrixX($att);
        return response()->json(
            UtilHelper::makeResponse('Hitung Matrix X ', $data),
            200
        );
    }

    public function hitungElectre(Request $req)
    {        
        $att = $req->validate([
                    'bobot_preferensi' => 'required|array',
                    'matrix_X' => 'required|array',                
                ]);
                        
        $data = $this->service->index($att);
        return response()->json(
            UtilHelper::makeResponse('Hitung Electre', $data),
            200
        );
    }


}