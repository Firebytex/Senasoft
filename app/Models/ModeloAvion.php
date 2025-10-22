<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloAvion extends Model
{
    //nombre de la tabla
    protected $table = 'modelos_avion';
//campos rellenables
    protected $fillable = [
        'nombre',
        'capacidad'
    ];
}
