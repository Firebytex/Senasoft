<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('vuelos.index');
});

*/

Route::get('/',[CiudadController::class,'index'])
    ->name('ciudades.lista');

Route::post('/vuelos/buscar', [VueloController::class, 'buscar'])
    ->name('vuelos.buscar');

Route::post('/reservas/seleccionar', [ReservaController::class, 'seleccionar'])
    ->name('reservas.seleccionar');

Route::post('/reservas', [ReservaController::class, 'store'])
    ->name('reservas.store');

Route::get('/reservas/{id}/confirmacion', [ReservaController::class, 'confirmacion'])
    ->name('reservas.confirmacion');

Route::resource('/ciudad',CiudadController::class);
//ruta administrador "CRUD" de vuelos
Route::resource('/admin',AdminController::class);
