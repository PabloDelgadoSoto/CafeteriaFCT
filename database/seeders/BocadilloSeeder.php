<?php

namespace Database\Seeders;

use App\Models\Bocadillo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BocadilloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bocadillos = [
        [
            'id'=>1,
            'nombre' => 'Bocadillo de pollo a la plancha',
            'precio' => 2.20,
            'descuento' => 1.60,
            'disponible' => true,
            'tipo_id' => 1
        ],
        [
            'nombre' => 'Montado de Serranito',
            'precio' => 2.40,
            'descuento' => 1.60,
            'disponible' => true,
            'tipo_id' => 2
        ],
        [
            'nombre' => 'Lomo',
            'precio' => 2.00,
            'disponible' => true,
            'tipo_id' => 3
        ],
        [
            'nombre' => 'Beicon',
            'precio' => 2.00,
            'descuento' => 1.60,
            'disponible' => true,
            'tipo_id' => 4
        ],
        [
            'nombre' => 'Tortilla de patatas',
            'precio' => 1.90,
            'disponible' => true,
            'tipo_id' => 5
        ],
        [
            'nombre' => 'Pincho de tortilla',
            'precio' => 1.70,
            'descuento' => 1.60,
            'disponible' => true,
            'tipo_id' => 6
        ],
        [
            'nombre' => 'Hamburguesa',
            'precio' => 3.00,
            'desmontable' => true,
            'disponible' => true,
            'tipo_id' => 7
        ],
        [
            'nombre' => 'Jamon Serrano',
            'precio' => 2.00,
            'disponible' => true,
            'tipo_id' => 8
        ],
        [
            'nombre' => 'Atun',
            'precio' => 1.80,
            'disponible' => true,
            'tipo_id' => 9
        ],
        [
            'nombre' => 'Sandwich de Jamon y queso',
            'precio' => 1.50,
            'disponible' => true,
            'tipo_id' => 10
        ],
        [
            'nombre' => 'Sandwich Vegetal',
            'precio' => 1.70,
            'disponible' => true,
            'tipo_id' => 11
        ],
        [
            'nombre' => 'Montado de tortilla',
            'precio' => 1.70,
            'disponible' => true,
            'tipo_id' => 12
        ],
        ];

        foreach ($bocadillos as $bocadillo) {
            Bocadillo::create($bocadillo);
        }
    }
}
