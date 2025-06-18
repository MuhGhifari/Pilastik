<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collector;

class CollectorController extends Controller
{

    public function index() {
        return view('collector.home');
    }
    
    public function collectionRunPage() {
        return view('collector.collection_run');
    }

    public function collectorMap() {
        return view('collector.map');
    }
}
