<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\CollectionRun;

class CollectionRunController extends Controller
{
    public function beginCollectionRun(Request $request)
    {
        $openRun = CollectionRun::where('end_time', null)->first();
        if ($openRun != null) {
            return redirect()->back()->with([
                'status' => 'fail', // or 'fail'
                'title' => 'Gagal!',
                'message' => 'Masih ada proses!'
            ]);
        }

        $run = new CollectionRun();
        $run->collector_id = auth()->user()->id;
        $run->vehicle_id = $request->vehicle_id;
        $run->start_time = now();
        $run->save();

        return redirect()->route('collector.map');
    }

    public function showAll()
    {
        $collectionRuns = CollectionRun::all();
        return response()->json(['collectionRuns' => $collectionRuns]);
    }

    public function show($id)
    {
        $collectionRun = CollectionRun::find($id);

        if (!$collectionRun) {
            return response()->json(['message' => 'Pengumpulan Sampah Tidak Ditemukan!'], 404);
        }

        return response()->json(['collectionRun' => $collectionRun]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'collector_id' => 'required|integer',
            'vehicle_id' => 'required|integer',
        ]);

        $collectionRun = CollectionRun::create($validated);

        return response()->json(['message' => 'Pengumpulan Sampah Dimulai!', 'collectionRun' => $collectionRun]);
    }

    public function update(Request $request, $id)
    {
        $collectionRun = CollectionRun::find($id);

        if (!$collectionRun) {
            return response()->json(['message' => 'Pengumpulan Sampah Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'end_time' => 'required|date',
            'status' => 'required|string',
        ]);

        $collectionRun->update($validated);

        return response()->json(['message' => 'Pengumpulan Sampah Diperbarui!', 'collectionRun' => $collectionRun]);
    }

    public function delete($id)
    {
        $collectionRun = CollectionRun::find($id);

        if (!$collectionRun) {
            return response()->json(['message' => 'Pengumpulan Sampah Tidak Ditemukan!'], 404);
        }

        $collectionRun->delete();

        return response()->json(['message' => 'Pengumpulan Sampah Dihapus!']);
    }

}
