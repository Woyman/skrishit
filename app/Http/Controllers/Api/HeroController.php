<?php

namespace App\Http\Controllers\Api;

use App\Services\HeroService;
use Illuminate\Http\Request;
use App\Utils\UtilHelper;


class HeroController 
{
    private $service;
    /**
     * HeroController constructor.
     * @param $service
     */
    public function __construct(HeroService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return response()->json(
            UtilHelper::makeResponse('List Hero', $data),
            200
        );
    }

    public function getOne($idHero)
    {
        $data = $this->service->getOne($idHero);
        return response()->json(
            UtilHelper::makeResponse('Get One Hero', $data),
            200
        );
    }

    public function insert(Request $req)
    {        
        $att = $req->all();                        
        $data = $this->service->insert($att);

        return response()->json(
            UtilHelper::makeResponse('Insert Hero', $data),
            200
        );
    }

    public function update(Request $req)
    {
        $att = $req->all();    
        // print_r($att);
        $data = $this->service->update($att);

        return response()->json(
            UtilHelper::makeResponse('Update Hero', $data),
            200
        );
    }

    public function delete($idHero)
    {                
        $data = $this->service->delete($idHero);

        return response()->json(
            UtilHelper::makeResponse('Delete Hero', $data),
            200
        );
    }
}