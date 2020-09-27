<?php

namespace App\Http\Controllers\Api;

use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class RoleController 
{
    private $service;
    /**
     * RoleController constructor.
     * @param $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return response()->json(
            UtilHelper::makeResponse('List Role', $data),
            200
        );
    }

    public function getOne($idRole)
    {
        $data = $this->service->getOne($idRole);
        return response()->json(
            UtilHelper::makeResponse('Get One Role', $data),
            200
        );
    }

    public function insert(Request $req)
    {
        $att = $req->validate(['role_name' => 'required|string']);
        // print_r($att);
        $data = $this->service->insert($att);

        return response()->json(
            UtilHelper::makeResponse('Insert Role', $data),
            200
        );
    }

    public function update(Request $req)
    {
        $att = $req->validate(['role_name' => 'required|string', '_id' => 'required|string' ]);
        // print_r($att);
        $data = $this->service->update($att);

        return response()->json(
            UtilHelper::makeResponse('Update Role', $data),
            200
        );
    }

    public function delete($idRole)
    {                
        $data = $this->service->delete($idRole);

        return response()->json(
            UtilHelper::makeResponse('Delete Role', $data),
            200
        );
    }
}