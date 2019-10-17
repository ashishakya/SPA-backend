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

Route::post('/quote', 'QuoteController@store')->middleware('auth:api');
Route::get('/quotes', 'QuoteController@index')->middleware('auth:api');
Route::put('/quotes/{id}', 'QuoteController@update');
Route::delete('/quotes/{id}', 'QuoteController@delete');
Route::post('/users', 'UserController@signup');
Route::post('/users/signin', 'UserController@signin');
Route::post('/users/logout', 'UserController@logout')->middleware('auth:api');
