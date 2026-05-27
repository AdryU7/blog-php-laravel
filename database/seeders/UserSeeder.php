<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // REGISTROS DE PRUEBA CON SEEDERS
        
        //1er registro
        $user1 = User::create([
            'full_name' => 'Gian Garcia',
            'email' => 'giangarcia@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrator');
        // Perfil de usuario 1
        Profile::create([
            'user_id' => $user1->id
        ]);

        //2do registro
        $user2 = User::create([
            'full_name' => 'Tony Mendez',
            'email' => 'tonymendez@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Author');
        // Perfil de usuario 2
        Profile::create([
            'user_id' => $user2->id
        ]);

        // Generar 10 registros
        User::factory(10)->create();
    }
}
