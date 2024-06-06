<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Elaboracion;

class ElaboracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elaboraciones = [
            [
            'id'=>1,
            'bocadillo_id'=>1,
            'ingrediente_id'=>1,
            'cantidad'
            ],[]
        ];

        foreach ($elaboraciones as $elaboracion) {
            Elaboracion::create($elaboracion);
        }
    }
}
