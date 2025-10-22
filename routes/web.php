<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VueloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('vuelos.index');
});

Route::resource('/vuelos',VueloController::class);
//ruta administrador "CRUD" de vuelos 
Route::resource('/admin',AdminController::class);
