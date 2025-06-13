<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collector;

class CollectorController extends Controller
{
    public function showAll(){
        $collectors = Collector::all();
        return response()->json(['collectors' => $collectors]);
    }

    public function show($id) {
        $collector = Collector::find($id);

        if (!$collector) {
            return response()->json(['message' => 'Collector Tidak Ditemukan!'], 404);
        }

        return response()->json(['collector' => $collector]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            // ...adjust validation rules as needed...
            'name' => 'required|string',
            // ...other fields...
        ]); 

        $collector = Collector::create($validated);

        return response()->json(['message' => 'Collector Ditambahkan!', 'collector' => $collector]);
    }

    public function update(Request $request, $id) {
        $collector = Collector::find($id);

        if (!$collector) {
            return response()->json(['message' => 'Collector Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            // ...adjust validation rules as needed...
            'name' => 'sometimes|required|string',
            // ...other fields...
        ]);

        $collector->update($validated);

        return response()->json(['message' => 'Collector Diperbarui!', 'collector' => $collector]);
    }

    public function delete($id) {
        $collector = Collector::find($id);

        if (!$collector) {
            return response()->json(['message' => 'Collector Tidak Ditemukan!'], 404);
        }

        $collector->delete();

        return response()->json(['message' => 'Collector Dihapus!']);
    }
}
