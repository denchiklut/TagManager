<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'pixel','middleware' => 'cors'], function () {

    Route::get('/tags/{hash_advertisings}', 'AdvertisingCampaigns@index');

});


Route::get('/pix/', 'AdvertisingPixel@index')->middleware(['cors']);


Route::get('pixeltest', ['middleware' => 'cors', function() {
    return "<script> var script = document.createElement('script'); script.src = '//sonar.semantiqo.com/4e3ll/check.js';  document.getElementsByTagName('head')[0].appendChild(script); </script>";
}]);