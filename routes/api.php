<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');    
});

Route::group(['middleware' => 'jwt.auth'], function($router){

    Route::get('/role', 'Api\RoleController@index'); 
    Route::get('/role/delete/{idRole}', 'Api\RoleController@delete'); 
    Route::get('/role/{idRole}', 'Api\RoleController@getOne'); 
    Route::post('/role', 'Api\RoleController@insert'); 
    Route::post('/role/update', 'Api\RoleController@update'); 

    Route::get('/speciality', 'Api\SpecialityController@index'); 
    Route::get('/speciality/delete/{idSpeciality}', 'Api\SpecialityController@delete'); 
    Route::get('/speciality/{idSpeciality}', 'Api\SpecialityController@getOne'); 
    Route::post('/speciality', 'Api\SpecialityController@insert'); 
    Route::post('/speciality/update', 'Api\SpecialityController@update'); 

    Route::get('/hero', 'Api\HeroController@index'); 
    Route::get('/hero/delete/{idHero}', 'Api\HeroController@delete'); 
    Route::get('/hero/{idHero}', 'Api\HeroController@getOne'); 
    Route::post('/hero', 'Api\HeroController@insert'); 
    Route::post('/hero/update', 'Api\HeroController@update'); 

    Route::get('/kriteria', 'Api\KriteriaController@index'); 
    Route::get('/kriteria/delete/{idHero}', 'Api\KriteriaController@delete'); 
    Route::get('/kriteria/{idHero}', 'Api\KriteriaController@getOne'); 
    Route::post('/kriteria', 'Api\KriteriaController@insert'); 
    Route::post('/kriteria/update', 'Api\KriteriaController@update'); 
   
});


Route::post('/electre', 'Api\ElectreController@index'); 
Route::post('/hitung-electre', 'Api\ElectreController@hitungElectre'); 
Route::get('/user/hero', 'Api\HeroController@index'); 
Route::get('/user/hero/{idHero}', 'Api\HeroController@getOne');
Route::get('/user/role', 'Api\RoleController@index');
Route::get('/user/speciality', 'Api\SpecialityController@index'); 
Route::get('/user/kriteria', 'Api\KriteriaController@index'); 






