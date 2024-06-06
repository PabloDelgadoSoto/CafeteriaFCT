<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Elaboracion;


class BocadillosIngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define las relaciones entre bocadillos e ingredientes
        $relaciones = [
            [
                'id'=>1,
                'bocadillo_id' => 1,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 1,
                'ingrediente_id' => 10,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 2,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 2,
                'ingrediente_id' => 13,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 2,
                'ingrediente_id' => 6,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 2,
                'ingrediente_id' => 11,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 3,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 3,
                'ingrediente_id' => 6,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 4,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 4,
                'ingrediente_id' => 5,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 5,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 5,
                'ingrediente_id' => 7,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 6,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 6,
                'ingrediente_id' => 7,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 7,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 7,
                'ingrediente_id' => 8,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 7,
                'ingrediente_id' => 9,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 8,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 8,
                'ingrediente_id' => 13,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 9,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 9,
                'ingrediente_id' => 12,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 10,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 10,
                'ingrediente_id' => 9,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 10,
                'ingrediente_id' => 13,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 11,
                'ingrediente_id' => 1,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 11,
                'ingrediente_id' => 2,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 11,
                'ingrediente_id' => 3,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 11,
                'ingrediente_id' => 4,
                'cantidad' => 1
            ],[
                'bocadillo_id' => 12,
                'ingrediente_id' => 1,
                'cantidad' => 0.5
            ],[
                'bocadillo_id' => 12,
                'ingrediente_id' => 7,
                'cantidad' => 0.5
            ],
        ];

        // Asocia los ingredientes con los bocadillos
        foreach ($relaciones as $r) {
            Elaboracion::create($r);
        }
    }
}
