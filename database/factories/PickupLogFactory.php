<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CollectionRun;
use App\Models\TrashBin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickupLog>
 */
class PickupLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $collectionRuns = CollectionRun::pluck('id')->toArray();
        $trashBins = TrashBin::pluck('id')->toArray();

        return [
            'collection_run_id' => fake()->randomElement($collectionRuns),
            'trash_bin_id' => fake()->randomElement($trashBins),
            'pickup_time' => fake()->dateTimeBetween('now', '+1 week'),
        ];
    }
}
