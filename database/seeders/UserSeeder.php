<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nia'=>'888888',
            'name'=>'Pablo Delgado Soto',
            'email'=>'pablodelsot@gmail.com',
            'password'=>'adminPablo'
        ])->assignRole('administrador');
        User::create([
            'nia'=>'666666',
            'name'=>'Juan ejemplo',
            'email'=>'juan123@gmail.com',
            'password'=>'ejemplo1'
        ])->assignRole('cliente');
    }
}
