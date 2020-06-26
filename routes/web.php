<?php

use Illuminate\Support\Facades\Route;

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


Route::get('users/password/{token}','UserController@resetPassword')->name('users.reset.password');
Route::post('users/password','UserController@changePassword')->name('users.change.password');

Route::prefix('api')->name('api.')->group(function () {

    Route::apiResource('/device', 'DeviceController');
    Route::put('device/status/{id}', 'DeviceController@status')->name('device.status');


});
