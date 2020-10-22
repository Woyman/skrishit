<?php

namespace App\Http\Controllers\Api;

use App\Services\ElectreService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class ElectreController 
{
    private $service;
    /**
     * RoleController constructor.
     * @param $service
     */
    public function __construct(ElectreService $service)
    {
        $this->service = $service;
    }

    public function index(Request $req)
    {
        $att = $req->validate([
                    'durability' => 'required|numeric',
                    'offense' => 'required|numeric',
                    'skill_effect' => 'required|numeric',
                    'difficulty' => 'required|numeric', 
                    'role' => 'array',
                    'speciality' => 'array'
                ]);
        // print_r($req->all());

        $data = $this->service->getmatrixX($att);
        return response()->json(
            UtilHelper::makeResponse('Hitung Electre', $data),
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