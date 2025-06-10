<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrashBin;
use App\Models\User;

class TrashBinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $residents = User::where('role', 'resident')->pluck('id')->toArray();
        
        foreach ($residents as $resident) {
            $location = [
                'latitude' => fake()->latitude(min: -6.589107, max: -6.594947),
                'longitude' => fake()->longitude(min: 106.819663, max: 106.830666),
            ];

            $capacity = fake()->randomElement([100, 200, 300]);
            $status = fake()->randomElement(['ready', 'collected']);
            
            TrashBin::factory()->create([
                'resident_id' => $resident,
                'bin_type' => 'organic',
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'capacity' => $capacity,
                'status' => $status,
            ]);  

            TrashBin::factory()->create([
                'resident_id' => $resident,
                'bin_type' => 'unorganic',
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'capacity' => $capacity,
                'status' => $status,
            ]);  
        }
    }
}
