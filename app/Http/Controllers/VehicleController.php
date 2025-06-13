<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function showAll(){
        $vehicles = Vehicle::all();
        return response()->json(['vehicles' => $vehicles]);
    }

    public function show($id) {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Kendaraan Tidak Ditemukan!'], 404);
        }

        return response()->json(['vehicle' => $vehicle]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'license_plate' => 'required|string',
            'vehicle_type' => 'required|string',
            'model' => 'required|string',
            'capacity' => 'required|integer',
        ]); 

        $vehicle = Vehicle::create($validated);

        return response()->json(['message' => 'Kendaraan Ditambahkan!', 'vehicle' => $vehicle]);
    }

    public function update(Request $request, $id) {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Kendaraan Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'license_plate' => 'sometimes|required|string',
            'vehicle_type' => 'sometimes|required|string',
            'model' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer',
        ]);

        $vehicle->update($validated);

        return response()->json(['message' => 'Kendaraan Diperbarui!', 'vehicle' => $vehicle]);
    }

    public function delete($id) {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Kendaraan Tidak Ditemukan!'], 404);
        }

        $vehicle->delete();

        return response()->json(['message' => 'Kendaraan Dihapus!']);
    }
}
