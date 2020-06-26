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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/login','API\AuthController@login');
Route::get('/all/devices', 'API\DeviceControllerAPI@index');
Route::post('/password/reset','API\AuthController@forgotPassword');

Route::middleware('auth:api')->group(function()
{
    Route::post('/password/change','API\AuthController@changePassword');
});
