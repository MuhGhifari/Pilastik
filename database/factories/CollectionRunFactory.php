<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollectionRun>
 */
class CollectionRunFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $collectors = User::where('role', 'collector')->pluck('id')->toArray();
        $vehicles = Vehicle::pluck('id')->toArray();

        return [
            'collector_id' => fake()->randomElement($collectors),
            'vehicle_id' => fake()->randomElement($vehicles),
            'start_time' => function () {
                $hour = fake()->numberBetween(7, 9);
                $minute = fake()->numberBetween(0, 59);
                return sprintf('%02d:%02d:00', $hour, $minute);
            },
            'end_time' => function () {
                $hour = fake()->numberBetween(15, 17);
                $minute = fake()->numberBetween(0, 59);
                return sprintf('%02d:%02d:00', $hour, $minute);
            },
            'status' => fake()->randomElement(['completed', 'cancelled'])
        ];
    }
}
