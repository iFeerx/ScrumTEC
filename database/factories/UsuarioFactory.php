<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\usuario>
 */
class UsuarioFactory extends Factory
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
        'control' => fake()->regexify('([A-Z]{1})?[0-9]{8}'),
        'nombre' => fake()->name(),
        'password' => static::$password ??= Hash::make('password'),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'esfuerzo_semanal' => fake()->numberBetween($min = 1, $max = 40),
        'apodo' => fake()->firstName(),
        'estatus' => fake()->randomElement(['activo', 'baja']),
        'remember_token' => Str::random(10),
        ];
    }
}
