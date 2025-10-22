<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{   
    //nombre tabla
    protected $table = "'ciudades";

    //campos rellenables
    protected $fillable = [
        'nombre',
        'codigo'
    ];



}
