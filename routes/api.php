<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', 'UserController@index');                 //mengambil semua user
Route::get('/user/{id}', 'UserController@showById');        //mengambil 1 user berdasarkan id
Route::get('/user/search/{nik}', 'UserController@cari');    //mengambil 1 user berdasarkan id
Route::post('/user/create', 'UserController@create');               //membuat data user baru
Route::post('/user/{id}', 'UserController@update');         //mengubah data user
Route::delete('/user/{id}', 'UserController@delete');       //menghapus data user


Route::get('ambulance', 'AmbulanceController@index');                 //mengambil semua data ambulance
Route::get('/ambulance/{id}', 'AmbulanceController@showById');        //mengambil 1 user berdasarkan id
Route::get('/ambulance/search/{namaAmbulance}', 'AmbulanceController@cari');    //mengambil 1 ambulance berdasarkan id
Route::post('/ambulance/create', 'AmbulanceController@create');               //membuat data ambulance baru
Route::post('/ambulance/update/{id}', 'AmbulanceController@update');         //mengubah data ambulance
Route::delete('/ambulance/delete/{id}', 'AmbulanceController@delete');       //menghapus data ambulance
