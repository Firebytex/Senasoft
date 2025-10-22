<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = 'vuelos';

    protected $fillable = [
        'modelo_avion',
        'fecha_vuelo',
        'precio_por_pasajero',
        'filas',
        'columnas'
    ];
}
