<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\VueloController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('vuelos.index');
});

*/

Route::get('/',[CiudadController::class,'index'])
    ->name('ciudades.lista');



Route::resource('/ciudad',CiudadController::class);
//ruta administrador "CRUD" de vuelos 
Route::resource('/admin',AdminController::class);
