<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModeloAvion;

class ModeloAvionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modelos = [
            ['nombre' => 'Boeing 737-800', 'capacidad' => 189],
            ['nombre' => 'Airbus A320', 'capacidad' => 180],
            ['nombre' => 'Boeing 787 Dreamliner', 'capacidad' => 242],
            ['nombre' => 'Airbus A319', 'capacidad' => 144],
            ['nombre' => 'Embraer E190', 'capacidad' => 114],
            ['nombre' => 'ATR 72-600', 'capacidad' => 72],
        ];

        foreach ($modelos as $modelo) {
            ModeloAvion::create($modelo);
        }
    }
}
