<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pasajero;


class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'codigo_reserva',
        'persona_id',
        'vuelo_ida_id',
        'vuelo_regreso_id',
        'pagador_nombre',
        'pagador_documento',
        'pagador_correo',
        'pagador_telefono',
        'metodo_pago',
        'valor_total'
    ];

    // Relaciones

    // Una reserva pertenece a una persona (opcional)
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    // Una reserva pertenece a un vuelo de ida
    public function vueloIdda()
    {
        return $this->belongsTo(Vuelo::class, 'vuelo_ida_id');
    }

    // Una reserva pertenece a un vuelo de regreso
    public function vueloRegreso()
    {
        return $this->belongsTo(Vuelo::class, 'vuelo_regreso_id');
    }

    // Una reserva tiene muchos pasajeros (relación muchos a muchos)
    public function pasajeros()
    {
        return $this->belongsToMany(Pasajero::class, 'pasajero_reserva');
    }
}
