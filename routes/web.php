<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('vuelos.index');
});


//ruta administrador "CRUD" de vuelos 
Route::resource('/admin',AdminController::class);
