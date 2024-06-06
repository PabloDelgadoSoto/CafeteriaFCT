<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredientes_extra;

class IngredientesExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extras = [
            [
            'id'=>1,
            'nombre'=>'pimiento',
            'coste_extra'=>'0.3',
            'cantidad'=> 5
            ],
            [
                'id'=>2,
                'nombre'=>'ketchup',
                'coste_extra'=>'0.5',
                'cantidad'=> 5
            ],
        ];

        foreach ($extras as $extra) {
            Ingredientes_extra::create($extra);
        };
    }
}
