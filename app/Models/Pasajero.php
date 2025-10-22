<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    protected $table = 'pasajeros';

    protected $fillable = [
        'primer_apellido',
        'segundo_apellido',
        'nombres',
        'fecha_nacimiento',
        'genero',
        'tipo_documento',
        'numero_documento',
        'es_infante',
        'celular',
        'correo'
    ];

}
