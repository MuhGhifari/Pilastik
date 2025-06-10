<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleSeeder::class,
            TrashBinSeeder::class,
            ScheduleSeeder::class,
            CollectionRunSeeder::class,
            PickupLogSeeder::class,
            RatingSeeder::class,
            NotificationSeeder::class,
            DropOffLocationSeeder::class,
            DropOffLogSeeder::class,
        ]);
    }
}
