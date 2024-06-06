<?php

namespace Database\Seeders;

use App\Models\Ingrediente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredientes;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientes = [
            [
                'id'=>1,
                'nombre' => 'Pan',
                'cantidad' => 20,
            ],
            [
                'nombre' => 'Lechuga',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Tomate',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Cebolla',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Becon',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Lomo',
                'cantidad' => 0,
            ],
            [
                'nombre' => 'Tortilla',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Hamburguesa',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Queso',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Pollo',
                'cantidad' => 0,
            ],
            [
                'nombre' => 'Pimiento',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Atún',
                'cantidad' => 10,
            ],
            [
                'nombre' => 'Jamon',
                'cantidad' => 10,
            ]
        ];

        foreach ($ingredientes as $ingrediente) {
            Ingrediente::create($ingrediente);
        }
    }
}
