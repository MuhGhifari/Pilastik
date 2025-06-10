<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DropOffLocation>
 */
class DropOffLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::where('role', 'admin')->pluck('id')->toArray();
        return [
            'location_id' => fake()->unique()->uuid(),
            'name' => fake()->company(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(min: -6.589107, max: -6.594947),
            'longitude' => fake()->longitude(min: 106.819663, max: 106.830666),
            'status' => fake()->randomElement(['active', 'inactive']),
            'description' => fake()->optional()->paragraph(),
            'created_by' => fake()->randomElement($users),
        ];
    }
}
