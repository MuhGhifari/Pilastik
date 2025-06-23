<?php

namespace Database\Seeders;

use App\Models\TrashBin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bins = TrashBin::all();

        foreach ($bins as $key => $bin) {
            Schedule::factory()->create([
                'trash_bin_id' => $bin->id
            ]);
        }

    }
}
