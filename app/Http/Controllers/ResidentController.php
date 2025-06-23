<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ResidentController extends Controller
{
    public function index() {
      
      $comments = auth()->user()->trashBins()->with('pickupLogs.rating')->get();
      // foreach ($comments as $comment) {
      //     foreach ($comment->pickupLogs as $pickupLog) {
      //         dd($pickupLog->rating->comments);
      //     }
      // }

      return view('resident.home', compact(['comments']));
    }
}
