<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciudad;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ciudades = [
            ['nombre' => 'Bogotá', 'codigo' => 'BOG'],
            ['nombre' => 'Medellín', 'codigo' => 'MDE'],
            ['nombre' => 'Cali', 'codigo' => 'CLO'],
            ['nombre' => 'Cartagena', 'codigo' => 'CTG'],
            ['nombre' => 'Barranquilla', 'codigo' => 'BAQ'],
            ['nombre' => 'Santa Marta', 'codigo' => 'SMR'],
            ['nombre' => 'Bucaramanga', 'codigo' => 'BGA'],
            ['nombre' => 'Pereira', 'codigo' => 'PEI'],
            ['nombre' => 'Cúcuta', 'codigo' => 'CUC'],
            ['nombre' => 'San Andrés', 'codigo' => 'ADZ'],
            ['nombre' => 'Armenia', 'codigo' => 'AXM'],
            ['nombre' => 'Manizales', 'codigo' => 'MZL'],
        ];

        foreach ($ciudades as $ciudad) {
            Ciudad::create($ciudad);
        }
    }
}
