<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


//ruta administrador "CRUD" de vuelos 
Route::resource('/admin',AdminController::class);


Route::get('/',function () {
    return view('admin.panel');
});