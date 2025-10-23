<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'tipo_documento',
        'numero_documento',
        'genero',
        'fecha_nacimiento',
        'telefono',
        'correo',
        'direccion'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];

    // Una persona puede tener muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
