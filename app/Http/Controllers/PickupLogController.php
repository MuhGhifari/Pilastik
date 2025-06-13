<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupLog;

class PickupLogController extends Controller
{
    public function showAll(){
        $logs = PickupLog::all();
        return response()->json(['pickupLogs' => $logs]);
    }

    public function show($id) {
        $log = PickupLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Pickup Log Tidak Ditemukan!'], 404);
        }

        return response()->json(['pickupLog' => $log]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'trash_bin_id' => 'required|integer',
            'collection_run_id' => 'required|integer',
            'pickup_time' => 'required|date',
        ]);

        $log = PickupLog::create($validated);

        return response()->json(['message' => 'Pickup Log Ditambahkan!', 'pickupLog' => $log]);
    }

    public function update(Request $request, $id) {
        $log = PickupLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Pickup Log Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'trash_bin_id' => 'required|integer',
            'collection_run_id' => 'required|integer',
            'pickup_time' => 'required|date',
        ]);

        $log->update($validated);

        return response()->json(['message' => 'Pickup Log Diperbarui!', 'pickupLog' => $log]);
    }

    public function delete($id) {
        $log = PickupLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Pickup Log Tidak Ditemukan!'], 404);
        }

        $log->delete();

        return response()->json(['message' => 'Pickup Log Dihapus!']);
    }
}
