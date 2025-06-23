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

        // Initialize role counters
        $counters = ['admin' => 0, 'resident' => 0, 'collector' => 0];

        // Manual entries with specific names and roles
        foreach ($users as $index => $name) {
            $role = $roles[$index];
            $counters[$role]++;
            $prefix = strtoupper(substr($role, 0, 1));
            $code = $prefix . str_pad($counters[$role], 3, '0', STR_PAD_LEFT);

            User::factory()->create([
                'name' => $name,
                'email' => strtolower($name . '@gmail.com'),
                'role' => $role,
                'password' => bcrypt('pass' . strtolower($name)),
                'user_code' => $code,
            ]);
        }

        // Generate random users and assign user_code accordingly
        $extraUsers = User::factory()->count(25)->create();

        foreach ($extraUsers as $user) {
            $role = $user->role;
            $counters[$role]++;
            $prefix = strtoupper(substr($role, 0, 1));
            $code = $prefix . str_pad($counters[$role], 3, '0', STR_PAD_LEFT);

            $user->user_code = $code;
            $user->save();
        }
    }
}
