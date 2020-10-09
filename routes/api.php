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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


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
// Route::get('/speciality/delete/{idSpeciality}', 'Api\SpecialityController@delete'); 
// Route::get('/speciality/{idSpeciality}', 'Api\SpecialityController@getOne'); 
Route::post('/hero', 'Api\HeroController@insert'); 
// Route::post('/speciality/update', 'Api\SpecialityController@update'); 
