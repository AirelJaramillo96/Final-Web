<?php


use Illuminate\Support\Facades\Route;

Route::view('/home', 'home')->name('home');
Route::view('/device/create', 'devices.create')->name('create.device');
Route::view('/device/{id}/edit', 'devices.edit')->name('edit.device');
