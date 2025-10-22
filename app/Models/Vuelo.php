<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ciudad;
use App\Models\ModeloAvion;


class Vuelo extends Model
{

    //nombre tabla en base de datos
    protected $table = 'vuelos';

    //campos rellenables
    protected $fillable = [
        'ciudad_origen_id',
        'ciudad_destino_id',
        'modelo_avion_id',
        'fecha',
        'hora',
        'precio',
        'asientos_disponibles',
        
    ];


    //casteos
    protected $casts = [
        'fecha' => 'date'
    ];

    //relaciones
    
    public function ciudadOrigen() {
        return $this->belongsTo(Ciudad::class,'ciudad_origen_id');
    }

    public function ciudadDestino() {
        return $this->belongsTo(Ciudad::class,'ciudad_destino_id');
    }


    public function modeloAvion() {
        return $this->belongsTo(ModeloAvion::class);
    }

}
