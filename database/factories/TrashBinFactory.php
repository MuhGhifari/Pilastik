<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrashBin>
 */
class TrashBinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $residents = User::where('role', 'resident')->pluck('id')->toArray();

        return [
            'resident_id' => fake()->randomElement($residents),
            'bin_type' => fake()->randomElement(['organic', 'inorganic']),
            'status' => fake()->randomElement(['ready', 'collected']),
            'latitude' => fake()->latitude(min: -6.589107, max: -6.594947),
            'longitude' => fake()->longitude(min: 106.819663, max: 106.830666),
            'capacity' => fake()->randomElement([100, 200, 300])
        ];
    }
}
