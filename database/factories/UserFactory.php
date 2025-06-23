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
        $role = fake()->randomElement(['admin', 'resident', 'collector']);

        $phoneNumber = fake()->unique()->phoneNumber();

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'role' => $role,
            'phone' => $phoneNumber,
            'password' => bcrypt($phoneNumber),
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-20 years'),
            'address' => fake()->address(),
        ];
    }
}
