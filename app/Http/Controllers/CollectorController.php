<?php

namespace App\Http\Controllers;

use App\Models\TrashBin;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Collector;

class CollectorController extends Controller
{

    public function index() {
        return view('collector.home');
    }
    
    public function collectionRunPage() {
        $vehicles = Vehicle::where('status', 'available');
        return view('collector.collection_run', compact('vehicles'));
    }

    public function collectorMap() {
        return view('collector.map');
    }

    public function ratingPage($id) {
        $trashBin = TrashBin::findOrFail($id);
        return view('collector.rating', compact('trashBin'));
    }
}
