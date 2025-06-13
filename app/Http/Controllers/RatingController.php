<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function showAll(){
        $ratings = Rating::all();
        return response()->json(['ratings' => $ratings]);
    }

    public function show($id) {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating Tidak Ditemukan!'], 404);
        }

        return response()->json(['rating' => $rating]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pickup_log_id' => 'required|integer',
            'score' => 'required|integer',
            'comment' => 'nullable|string',
        ]); 

        $rating = Rating::create($validated);

        return response()->json(['message' => 'Rating Ditambahkan!', 'rating' => $rating]);
    }

    public function update(Request $request, $id) {
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

    public function delete($id) {
        $rating = Rating::find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating Tidak Ditemukan!'], 404);
        }

        $rating->delete();

        return response()->json(['message' => 'Rating Dihapus!']);
    }
}
