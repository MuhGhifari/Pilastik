<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\TrashBin;

class TrashBinController extends Controller
{
    public function showAll(){
        $bins = TrashBin::all();
        return response()->json(['trashBins' => $bins]);
    }

    public function show($id) {
        $bin = TrashBin::find($id);

        if (!$bin) {
            return response()->json(['message' => 'Trash Bin Tidak Ditemukan!'], 404);
        }

        return response()->json(['trashBin' => $bin]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'resident_id' => 'required|integer',
            'bin_type' => ['required', Rule::in(TrashBin::BIN_TYPES)],
            'status' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'capacity' => 'required|numeric',
        ]); 

        $bin = TrashBin::create($validated);

        return response()->json(['message' => 'Trash Bin Ditambahkan!', 'trashBin' => $bin]);
    }

    public function update(Request $request, $id) {
        $bin = TrashBin::find($id);

        if (!$bin) {
            return response()->json(['message' => 'Trash Bin Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'resident_id' => 'required|integer',
            'bin_type' => ['required', Rule::in(TrashBin::BIN_TYPES)],
            'status' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'capacity' => 'required|numeric',
        ]);

        $bin->update($validated);

        return response()->json(['message' => 'Trash Bin Diperbarui!', 'trashBin' => $bin]);
    }

    public function delete($id) {
        $bin = TrashBin::find($id);

        if (!$bin) {
            return response()->json(['message' => 'Trash Bin Tidak Ditemukan!'], 404);
        }

        $bin->delete();

        return response()->json(['message' => 'Trash Bin Dihapus!']);
    }
}
