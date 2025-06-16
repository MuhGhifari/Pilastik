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
            User::factory()->create([
                'name' => $name,
                'email' => strtolower($name . '@gmail.com'),
                'role' => $roles[$index],
                'password' => bcrypt('pass' . strtolower($name)),
            ]);
        }


        User::factory()->count(25)->create();
    }
}
