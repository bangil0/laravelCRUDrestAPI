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

Route::get('user', 'UserController@index'); //!mengambil semua user
Route::get('/user/{id}', 'UserController@showById'); //!mengambil 1 user berdasarkan id
Route::post('user', 'UserController@create');
Route::post('/user/{id}', 'UserController@update');
Route::delete('/user/{id}', 'UserController@delete');
