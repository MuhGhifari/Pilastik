<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CollectionRun;
use App\Models\DropOffLocation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DropOffLog>
 */
class DropOffLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $collectionRuns = CollectionRun::pluck('id')->toArray();
        $dropOffLocations = DropOffLocation::pluck('id')->toArray();
        return [
            'collection_run_id' => fake()->randomElement($collectionRuns),
            'drop_off_location_id' => fake()->randomElement($dropOffLocations),
            'weight' => fake()->numberBetween(100, 1000), // Weight in kg
            'drop_off_time' => fake()->dateTimeBetween('now', '+1 week'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
