<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // REGISTROS DE PRUEBA CON SEEDERS
        /*
        //1er registro
        User::create([
            'full_name' => 'Gian Garcia',
            'email' => 'giangarcia@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        //2do registro
        User::create([
            'full_name' => 'Tony Mendez',
            'email' => 'tonymendez@gmail.com',
            'password' => Hash::make('12345678'),
        ]);*/
        // Generar 10 registros
        User::factory(10)->create();
    }
}
