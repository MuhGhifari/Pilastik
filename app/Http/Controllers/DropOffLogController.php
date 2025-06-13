<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DropOffLog;

class DropOffLogController extends Controller
{
    public function showAll(){
        $logs = DropOffLog::all();
        return response()->json(['dropOffLogs' => $logs]);
    }

    public function show($id) {
        $log = DropOffLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Drop Off Log Tidak Ditemukan!'], 404);
        }

        return response()->json(['dropOffLog' => $log]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'drop_off_location_id' => 'required|integer',
            'collection_run_id' => 'required|integer',
            'weight' => 'required|numeric',
            'drop_off_time' => 'required|date',
            'notes' => 'nullable|string'
        ]); 

        $log = DropOffLog::create($validated);

        return response()->json(['message' => 'Drop Off Log Ditambahkan!', 'dropOffLog' => $log]);
    }

    public function update(Request $request, $id) {
        $log = DropOffLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Drop Off Log Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'drop_off_location_id' => 'required|integer',
            'collection_run_id' => 'required|integer',
            'weight' => 'required|numeric',
            'drop_off_time' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $log->update($validated);

        return response()->json(['message' => 'Drop Off Log Diperbarui!', 'dropOffLog' => $log]);
    }

    public function delete($id) {
        $log = DropOffLog::find($id);

        if (!$log) {
            return response()->json(['message' => 'Drop Off Log Tidak Ditemukan!'], 404);
        }

        $log->delete();

        return response()->json(['message' => 'Drop Off Log Dihapus!']);
    }
}
