<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::pluck('id')->toArray();
        return [
            'type' => fake()->randomElement(['pickup', 'drop_off', 'reminder']),
            'user_id' => fake()->randomElement($users),
            'data' => fake()->sentence(),
            'read' => fake()->randomElement([true, false]),
            'read_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
