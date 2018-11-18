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


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'pixel'], function () {

    Route::get('/tags/{hash_advertisings}', 'AdvertisingCampaigns@index');
});

Route::group(['prefix' => 'add'], function () {
    Route::get('/pixel/{compaigns_url}', 'AddPixel@index');
});


Route::group(['prefix' => 'auth' ], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::group(['middleware' => 'jwt.auth' ], function ($router) {
    Route::resource('/', 'AnaliticsController');
    Route::resource('companies', 'AddPixel');
    Route::get('/defaults', 'ContainersController@defaults');
    Route::resource('containers', 'ContainersController');
    Route::resource('templates', 'TemplatesController');
});

