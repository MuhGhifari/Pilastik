<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate' => fake()->unique()->bothify('??###??'),
            'vehicle_type' => fake()->randomElement(['truck', 'trolley', 'motorcycle']),
            'model' => fake()->word(),
            'status' => fake()->randomElement(['available', 'in_use', 'maintenance']),
            'capacity' => fake()->numberBetween(100, 1000), // Capacity in kg
        ];
    }
}
