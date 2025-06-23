<?php

namespace App\Http\Controllers;

use App\Models\TrashBin;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Collector;

class CollectorController extends Controller
{

    public function index()
    {
        return view('collector.home');
    }

    public function collectionRunPage()
    {
        $schedules = auth()->user()->collector_schedules()->with('trashBin.resident')->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('collector.collection_run', compact(['vehicles', 'schedules']));
    }

    public function collectorMap()
    {
        $collection_run = auth()->user()->collectionRuns->where('status', 'in_progress')->first();
        $schedules = auth()->user()->collector_schedules()->with('trashBin.resident')->get();
        return view('collector.map', compact(['collection_run', 'schedules']));
    }

    public function ratingPage($id)
    {
        $trashBin = TrashBin::findOrFail($id);
        $resident = $trashBin->resident;
        return view('collector.rating', compact(['trashBin', 'resident']));
    }
}
