<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::factoryForModel(User::class);

        $users = ['Hendra', 'Rina', 'Anjani', 'Suryono', 'Haris', 'Adit'];
        $roles = ['admin', 'resident', 'resident', 'collector', 'resident', 'collector'];

        foreach ($users as $index => $name) {
            User::create([
                'name' => $name,
                'username' => strtolower($name),
                'password' => bcrypt($roles[$index]), // Use a secure password in production
                'role' => $roles[$index],
                'phone' => fake()->unique()->phoneNumber(),
            ]);
        }

        User::factory()->count(25)->create();
    }
}
