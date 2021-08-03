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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', '\App\Http\Controllers\Auth\LoginController@loginOrSignIn');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/high-scores', '\App\Http\Controllers\Api\GameController@getHighScores');

//Game
Route::get('/check-number/{number}', '\App\Http\Controllers\Api\GameController@checkNumber');
Route::get('/start', '\App\Http\Controllers\Api\GameController@start');
