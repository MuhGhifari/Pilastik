<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PickupLog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pickupLogIds = PickupLog::pluck('id')->toArray();

        return [
            'pickup_log_id' => fake()->randomElement($pickupLogIds),
            'score' => fake()->numberBetween(1, 5),
            'comments' => fake()->sentence(),
        ];
    }
}
