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
//TODO
Route::get('index', 'UserController@index');
Route::post('register', 'UserController@register');

// This routes are for test purpose at the frontend
Route::post('locations', 'LocationsController@store');
Route::post('sensors', 'SensorsController@store');
Route::post('devices', 'DevicesController@store');

//Login for posting
Route::post('login', 'UserController@login');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'UserController@details');
    Route::post('measurements', 'MeasurementsController@store');
    //Route::post('locations', 'LocationsController@store');
    //Route::post('sensors', 'SensorsController@store');
    //Route::post('devices', 'DevicesController@store');
});
//Public measurments routes
Route::get('measurements', 'MeasurementsController@index');
Route::get('measurements/{id}', 'MeasurementsController@show');
//Public locations routes
Route::get('locations', 'LocationsController@index');
Route::get('locations/{id}', 'LocationsController@show');
Route::get('locations/{roomnumber}', 'locationData@show');
//Public devices routes
Route::get('devices', 'DevicesController@index');
Route::get('devices/{id}', 'DevicesController@show');
//Public sensors routes
Route::get('sensors', 'SensorsController@index');
Route::get('sensors/{id}', 'SensorsController@show');
//Routes for the TTN listener
Route::post('listener', 'TTNDataController@store');
