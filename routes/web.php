<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;


Route::get('/vuelosreserva',[ VueloController::class,'index'])
    ->name('vuelos.index');


//Vista donde traemos todos los vuelos con las ciudades
Route::get('/',[CiudadController::class,'index'])
    ->name('ciudades.lista');


//ruta con el metodo de buscar
Route::post('/vuelos/buscar', [VueloController::class, 'buscar'])
    ->name('vuelos.buscar');


//seleccionar
Route::post('/reservas/seleccionar', [ReservaController::class, 'seleccionar'])
    ->name('reservas.seleccionar');

    //guardamos la reserva en db
Route::post('/reservas', [ReservaController::class, 'store'])
    ->name('reservas.store');

Route::get('/reservas/{id}/confirmacion', [ReservaController::class, 'confirmacion'])
    ->name('reservas.confirmacion');



//ruta crud para ciudades **SIN HACER AÚN**
Route::resource('/ciudad',CiudadController::class);




//ruta administrador "CRUD" de vuelos

//panel admin
Route::resource('admin',AdminController::class);
