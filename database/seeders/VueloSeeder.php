<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vuelo;
use App\Models\Ciudad;
use App\Models\ModeloAvion;

class VueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ciudades = Ciudad::all();
        $modelos = ModeloAvion::all();

        // Generar vuelos de ejemplo
        $vuelos = [
            // Bogotá a otras ciudades
            ['origen' => 'Bogotá', 'destino' => 'Medellín', 'fecha' => '2025-10-25', 'hora' => '08:00:00', 'precio' => 150000],
            ['origen' => 'Bogotá', 'destino' => 'Medellín', 'fecha' => '2025-10-25', 'hora' => '14:00:00', 'precio' => 165000],
            ['origen' => 'Bogotá', 'destino' => 'Cali', 'fecha' => '2025-10-26', 'hora' => '09:00:00', 'precio' => 180000],
            ['origen' => 'Bogotá', 'destino' => 'Cartagena', 'fecha' => '2025-10-27', 'hora' => '10:30:00', 'precio' => 220000],
            ['origen' => 'Bogotá', 'destino' => 'San Andrés', 'fecha' => '2025-10-28', 'hora' => '11:00:00', 'precio' => 350000],

            // Medellín a otras ciudades
            ['origen' => 'Medellín', 'destino' => 'Bogotá', 'fecha' => '2025-10-25', 'hora' => '16:00:00', 'precio' => 155000],
            ['origen' => 'Medellín', 'destino' => 'Cartagena', 'fecha' => '2025-10-26', 'hora' => '12:00:00', 'precio' => 200000],
            ['origen' => 'Medellín', 'destino' => 'Cali', 'fecha' => '2025-10-27', 'hora' => '15:00:00', 'precio' => 170000],

            // Cali a otras ciudades
            ['origen' => 'Cali', 'destino' => 'Bogotá', 'fecha' => '2025-10-26', 'hora' => '18:00:00', 'precio' => 175000],
            ['origen' => 'Cali', 'destino' => 'Medellín', 'fecha' => '2025-10-27', 'hora' => '07:00:00', 'precio' => 168000],

            // Cartagena a otras ciudades
            ['origen' => 'Cartagena', 'destino' => 'Bogotá', 'fecha' => '2025-10-27', 'hora' => '19:00:00', 'precio' => 215000],
            ['origen' => 'Cartagena', 'destino' => 'Medellín', 'fecha' => '2025-10-28', 'hora' => '13:00:00', 'precio' => 195000],

            // San Andrés a otras ciudades
            ['origen' => 'San Andrés', 'destino' => 'Bogotá', 'fecha' => '2025-10-28', 'hora' => '17:00:00', 'precio' => 340000],

            // Barranquilla
            ['origen' => 'Bogotá', 'destino' => 'Barranquilla', 'fecha' => '2025-10-29', 'hora' => '08:30:00', 'precio' => 210000],
            ['origen' => 'Barranquilla', 'destino' => 'Bogotá', 'fecha' => '2025-10-29', 'hora' => '16:30:00', 'precio' => 205000],

            // Santa Marta
            ['origen' => 'Bogotá', 'destino' => 'Santa Marta', 'fecha' => '2025-10-30', 'hora' => '09:00:00', 'precio' => 225000],
            ['origen' => 'Santa Marta', 'destino' => 'Bogotá', 'fecha' => '2025-10-30', 'hora' => '18:00:00', 'precio' => 220000],

            // Bucaramanga
            ['origen' => 'Bogotá', 'destino' => 'Bucaramanga', 'fecha' => '2025-10-23', 'hora' => '10:00:00', 'precio' => 190000],
            ['origen' => 'Bucaramanga', 'destino' => 'Bogotá', 'fecha' => '2025-10-24', 'hora' => '15:00:00', 'precio' => 185000],


            /*
            //S
            ['origen' => 'Medellín', 'destino' => 'Cali', 'fecha' => '2025-10-23', 'hora' => '10:00:00', 'precio' => 190000],
            ['origen' => 'Cali', 'destino' => 'Medellín', 'fecha' => '2025-10-24', 'hora' => '15:00:00', 'precio' => 185000],

            */
        ];

        foreach ($vuelos as $vueloData) {
            $origen = $ciudades->where('nombre', $vueloData['origen'])->first();
            $destino = $ciudades->where('nombre', $vueloData['destino'])->first();
            $modelo = $modelos->random();

            if ($origen && $destino) {
                Vuelo::create([
                    'ciudad_origen_id' => $origen->id,
                    'ciudad_destino_id' => $destino->id,
                    'modelo_avion_id' => $modelo->id,
                    'fecha' => $vueloData['fecha'],
                    'hora' => $vueloData['hora'],
                    'precio' => $vueloData['precio'],
                    'asientos_disponibles' => $modelo->capacidad,
                ]);
            }
        }
    }
}
