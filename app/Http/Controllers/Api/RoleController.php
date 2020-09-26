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
            UtilHelper::makeResponse('dashboard', $data),
            200
        );
    }

    public function insert(Request $req)
    {
        $att = $req->validate(['role_name' => 'required|string']);

        $data = $this->service->insert($att);

        return response()->json(
            UtilHelper::makeResponse('dashboard', $data),
            200
        );
    }
}