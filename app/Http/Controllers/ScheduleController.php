<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function showAll(){
        $schedules = Schedule::all();
        return response()->json(['schedules' => $schedules]);
    }

    public function show($id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Jadwal Tidak Ditemukan!'], 404);
        }

        return response()->json(['schedule' => $schedule]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'collector_id' => 'required|integer',
            'trash_bin_id' => 'required|integer',
            'schedule_time' => 'required|date_format:H:i',
        ]); 

        $schedule = Schedule::create($validated);

        return response()->json(['message' => 'Jadwal Ditambahkan!', 'schedule' => $schedule]);
    }

    public function update(Request $request, $id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Jadwal Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'collector_id' => 'required|integer',
            'trash_bin_id' => 'required|integer',
            'schedule_time' => 'required|date_format:H:i',
        ]);

        $schedule->update($validated);

        return response()->json(['message' => 'Jadwal Diperbarui!', 'schedule' => $schedule]);
    }

    public function delete($id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Jadwal Tidak Ditemukan!'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Jadwal Dihapus!']);
    }
}
