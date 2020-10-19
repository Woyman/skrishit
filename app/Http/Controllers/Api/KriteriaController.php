<?php

namespace App\Http\Controllers\Api;

use App\Services\KriteriaService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class KriteriaController 
{
    private $service;
    /**
     * RoleController constructor.
     * @param $service
     */
    public function __construct(KriteriaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return response()->json(
            UtilHelper::makeResponse('List Kriteria', $data),
            200
        );
    }

    public function getOne($idRole)
    {
        $data = $this->service->getOne($idRole);
        return response()->json(
            UtilHelper::makeResponse('Get One Kriteria', $data),
            200
        );
    }

    public function insert(Request $req)
    {
        $att = $req->validate(['kriteria_name' => 'required|string',
                               'kriteria_field' => 'required|string']);
        // print_r($att);
        $data = $this->service->insert($att);

        return response()->json(
            UtilHelper::makeResponse('Insert Kriteria', $data),
            200
        );
    }

    public function update(Request $req)
    {
        $att = $req->validate(['kriteria_name' => 'required|string', 
                               '_id' => 'required|string',
                               'kriteria_field' => 'required|string'] );
        // print_r($att);
        $data = $this->service->update($att);

        return response()->json(
            UtilHelper::makeResponse('Update Kriteria', $data),
            200
        );
    }

    public function delete($idRole)
    {                
        $data = $this->service->delete($idRole);

        return response()->json(
            UtilHelper::makeResponse('Delete Kriteria', $data),
            200
        );
    }
}