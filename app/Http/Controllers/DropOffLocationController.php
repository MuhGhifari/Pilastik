<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\DropOffLocation;

class DropOffLocationController extends Controller
{
    public function showAll(){
        $locations = DropOffLocation::all();
        return response()->json(['dropOffLocations' => $locations]);
    }

    public function show($id) {
        $location = DropOffLocation::find($id);

        if (!$location) {
            return response()->json(['message' => 'Drop Off Location Tidak Ditemukan!'], 404);
        }

        return response()->json(['dropOffLocation' => $location]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'location_id' => 'required|integer',
            'name' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => ['required', Rule::in(DropOffLocation::STATUS)],
            'description' => 'required|numeric',
            'created_by' => 'required|numeric',
            'updated_by' => 'required|numeric',
        ]); 

        $location = DropOffLocation::create($validated);

        return response()->json(['message' => 'Drop Off Location Ditambahkan!', 'dropOffLocation' => $location]);
    }

    public function update(Request $request, $id) {
        $location = DropOffLocation::find($id);

        if (!$location) {
            return response()->json(['message' => 'Drop Off Location Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);

        $location->update($validated);

        return response()->json(['message' => 'Drop Off Location Diperbarui!', 'dropOffLocation' => $location]);
    }

    public function delete($id) {
        $location = DropOffLocation::find($id);

        if (!$location) {
            return response()->json(['message' => 'Drop Off Location Tidak Ditemukan!'], 404);
        }

        $location->delete();

        return response()->json(['message' => 'Drop Off Location Dihapus!']);
    }
}
