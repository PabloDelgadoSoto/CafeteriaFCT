<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(TiposSeeder::class);
        $this->call(BocadilloSeeder::class);
        $this->call(IngredienteSeeder::class);
        $this->call(BocadillosIngredientesSeeder::class);
        $this->call(IngredientesExtraSeeder::class);
    }
}
