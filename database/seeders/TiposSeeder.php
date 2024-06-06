<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
        [
            'id'=>1,
            'nombre' => 'Pollo a la plancha',
            'descripcion' => 'Bocadillo de pollo a la plancha',
            'extras' => true,
            'imagen' => '1712836553_Captura de tinker.png',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Serranito',
            'descripcion' => 'Bocadillo de jamon, pimineto verde y lomo',
            'extras' => true,
            'imagen' => 'serranito.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Lomo',
            'descripcion' => 'Bocadillo de lomo',
            'extras' => true,
            'imagen' => 'lomo.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Beicon',
            'descripcion' => 'Bocadillo de beicon',
            'extras' => true,
            'imagen' => 'beicon.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Tortilla de patatas',
            'descripcion' => 'Bocadillo de tortilla de patatas',
            'extras' => true,
            'imagen' => 'tortilla_patatas.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Pincho de tortilla',
            'descripcion' => 'Bocadillo de pincho de tortilla',
            'extras' => true,
            'imagen' => 'pincho_tortilla.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Hamburguesa',
            'descripcion' => 'Hamburguesa de carne con queso',
            'extras' => true,
            'imagen' => 'hamburguesa.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Jamon Serrano',
            'descripcion' => 'Bocadillo de Jamon Serrano',
            'extras' => true,
            'imagen' => 'Serrano.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Atun',
            'descripcion' => 'Bocadillo de Atun',
            'extras' => true,
            'imagen' => 'atun.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Sandwich de Jamon y queso',
            'descripcion' => 'Sandwich de jamon y queso',
            'extras' => true,
            'imagen' => 'jamon_queso.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Sandwich Vegetal',
            'descripcion' => 'Sandwich de verduras',
            'extras' => true,
            'imagen' => 'vegetal.jpg',
            'categoria_id' => 1
        ],
        [
            'nombre' => 'Montado de tortilla',
            'descripcion' => 'Montado de tortilla',
            'extras' => true,
            'imagen' => 'vegetal.jpg',
            'categoria_id' => 1
        ],
        ];

        foreach ($tipos as $tipo) {
            Tipo::create($tipo);
        }
    }
}
