<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // Método para crear el perfil automáticamente
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->profile()->create([]);
        });
    }
}

/*
Crear perfiles manualmente desde Tinker en caso de que el User
no tenga uno

-- bash --
> php artisan tinker

-- php --
// Esto creará perfiles para todos los usuarios que no tengan uno
App\Models\User::doesntHave('profile')->each(function($user) {
    $user->profile()->create([
        'profession' => null,
        'about' => null,
    ]);
});
*/