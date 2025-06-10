<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TrashBin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $collectors = User::where('role', 'collector')->pluck('id')->toArray();
        $trashBins = TrashBin::pluck('id')->toArray();
        $admins = User::where('role', 'admin')->pluck('id')->toArray();

        return [
            'collector_id' => fake()->randomElement($collectors),
            'trash_bin_id' => fake()->randomElement($trashBins),
            'scheduled_time' => function () {
                $hour = fake()->numberBetween(7, 16);
                $minute = fake()->numberBetween(0, 59);
                return sprintf('%02d:%02d:00', $hour, $minute);
            },
            'created_by' => fake()->randomElement($admins),
            'updated_by' => fake()->randomElement($admins),
        ];
    }
}
