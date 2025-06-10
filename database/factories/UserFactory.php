<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        // First, randomly select a role.
        // I've changed 'user' to 'resident' to match your password requirements.
        $role = fake()->randomElement(['admin', 'resident', 'collector']);

        // Then, determine the password based on the selected role.
        $password = 'password'; // Default password
        switch ($role) {
            case 'admin':
                $password = 'adminadmin';
                break;
            case 'resident':
                $password = 'warga';
                break;
            case 'collector':
                $password = 'kolektor';
                break;
        }

        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->username(),
            'password' => static::$password ??= bcrypt($password),
            'role' => $role,
            'phone' => fake()->unique()->phoneNumber(),
        ];
    }
}
