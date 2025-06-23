<?php

namespace App\Http\Controllers;

use App\Models\PickupLog;
use App\Models\TrashBin;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function showAll()
    {
        $ratings = Rating::all();
        return response()->json(['ratings' => $ratings]);
    }

    public function show($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating Tidak Ditemukan!'], 404);
        }

        return response()->json(['rating' => $rating]);
    }

    public function store(Request $request)
    {
        $pickupLog = new PickupLog();
        $pickupLog->trash_bin_id = $request->trash_bin_id;
        $pickupLog->weight = $request->weight;
        $pickupLog->collection_run_id = auth()->user()->collectionRuns->where('status', 'in_progress')->first()->id;
        $pickupLog->save();

        $validated = $request->validate([
            'score' => 'required|integer',
            'comments' => 'nullable|string',
        ]);

        // $rating = Rating::create($validated);
        $rating = new Rating();
        $rating->pickup_log_id = $pickupLog->id;
        $rating->score = $validated['score'];
        $rating->comments = $validated['comments'];
        $rating->save();

        $bin = TrashBin::find($request->trash_bin_id);
        $bin->status = 'collected';
        $bin->status;
        $bin->save();

        // return response()->json(['message' => 'Rating Ditambahkan!', 'rating' => $rating]);
        return redirect()->route('collector.index')->with([
            'status' => 'success', // or 'fail'
            'title' => 'Berhasil!',
            'message' => 'Rating disimpan.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'pickup_log_id' => 'required|integer',
            'score' => 'sometimes|required|integer',
            'comment' => 'nullable|string',
        ]);

        $rating->update($validated);

        return response()->json(['message' => 'Rating Diperbarui!', 'rating' => $rating]);
    }

    public function delete($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating Tidak Ditemukan!'], 404);
        }

        $rating->delete();

        return response()->json(['message' => 'Rating Dihapus!']);
    }
}
