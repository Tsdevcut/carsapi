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


Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::middleware(['auth:api'])->group(function() {
  //List the cars
  Route::get('/cars', 'API\CarController@index');

  //List single car
  Route::get('/car/{id}', 'API\CarController@show');

  //Create new car
  Route::post('/car', 'API\CarController@store');

  //update car
  Route::post('/car/{id}', 'API\CarController@update');

  //Delete Car
  Route::delete('/car/{id}', 'API\CarController@destroy');
});
