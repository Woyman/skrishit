<?php

namespace App\Http\Controllers\Api;

use App\Services\SpecialityService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class SpecialityController 
{
    private $service;
    /**
     * SpecialityController constructor.
     * @param $service
     */
    public function __construct(SpecialityService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return response()->json(
            UtilHelper::makeResponse('List Speciality', $data),
            200
        );
    }

    public function getOne($idSpeciality)
    {
        $data = $this->service->getOne($idSpeciality);
        return response()->json(
            UtilHelper::makeResponse('Get One Speciality', $data),
            200
        );
    }

    public function insert(Request $req)
    {
        $att = $req->validate(['speciality_name' => 'required|string']);
        // print_r($att);
        $data = $this->service->insert($att);

        return response()->json(
            UtilHelper::makeResponse('Insert Speciality', $data),
            200
        );
    }

    public function update(Request $req)
    {
        $att = $req->validate(['speciality_name' => 'required|string', '_id' => 'required|string' ]);
        // print_r($att);
        $data = $this->service->update($att);

        return response()->json(
            UtilHelper::makeResponse('Update Speciality', $data),
            200
        );
    }

    public function delete($idSpeciality)
    {                
        $data = $this->service->delete($idSpeciality);

        return response()->json(
            UtilHelper::makeResponse('Delete Speciality', $data),
            200
        );
    }
}