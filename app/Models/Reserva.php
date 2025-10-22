<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pasajero;


class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'codigo_reserva',
        'vuelo_ida_id',
        'vuelo_regreso_id',
        'pagador_nombre',
        'pagador_documento',
        'pagador_correo',
        'pagador_telefono',
        'metodo_pago',
        'valor_total'
    ];

        //relaciones

    //UNA RESERVA PERTENECE A UN VUELO
    public function vueloIdda() {
        return $this->belongsTo(Vuelo::class,'vuelo_ida_id');

    }

    //una reserva perteneca un vuelo de regreso
    public function vueloRegreso() {
        return $this->belongsTo(Vuelo::class,'vuelo_regreso_id');
    }

    //una reserva tiene muchos pasajeros 
    public function pasajeros() {
        return $this->hasMany(Pasajero::class);
    }
}
