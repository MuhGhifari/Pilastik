<?php

namespace App\Http\Controllers;

use App\Models\PickupLog;
use App\Models\TrashBin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show()
    {
        return view('test');
    }

    public function test(Request $request)
    {
        $query = TrashBin::query();

        if (request()->has('id') && request()->id) {
            $query->where('id', (int) substr(request()->id, 2));
        }

        if (request()->has('bin_type') && request()->bin_type) {
            $query->where('bin_type', request()->bin_type);
        }

        $trashBins = $query->get();

        $pdf = Pdf::loadView('reports.trash-report', compact('trashBins'));

        return $pdf->stream('laporan-tempat-sampah.pdf');
    }

    public function report(Request $request) {
        $weeklyWaste = PickupLog::join('trash_bins', 'pickup_logs.trash_bin_id', '=', 'trash_bins.id')
            ->selectRaw('DAYOFWEEK(pickup_time) as day_num, trash_bins.bin_type, SUM(weight) as total')
            ->groupBy('day_num', 'trash_bins.bin_type')
            ->get()
            ->groupBy('bin_type')
            ->map(function ($items) {
            // Map day numbers to Indonesian day names
            $daysIndo = [
                1 => 'Minggu',
                2 => 'Senin',
                3 => 'Selasa',
                4 => 'Rabu',
                5 => 'Kamis',
                6 => 'Jumat',
                7 => 'Sabtu',
            ];
            // Collect data with all days, fill missing with 0
            $result = [];
            foreach ($daysIndo as $num => $name) {
                $found = $items->firstWhere('day_num', $num);
                $result[$name] = $found ? $found->total : 0;
            }
            return collect($result);
            });

        $totalOrganic = $weeklyWaste->has('organic') ? $weeklyWaste['organic']->sum() : 0;
        $totalInorganic = $weeklyWaste->has('inorganic') ? $weeklyWaste['inorganic']->sum() : 0;
        
        $totalTrashBins = TrashBin::all()->count();
        $totalCollectedBins = TrashBin::where('status', 'collected')->count();
        $progressPercentage = $totalTrashBins > 0 ? round(($totalCollectedBins / $totalTrashBins) * 100) : 0;

        $pdf = Pdf::loadView('reports.general-report', compact(
            'weeklyWaste',
            'totalTrashBins',
            'totalCollectedBins',
            'progressPercentage',
            'totalOrganic',
            'totalInorganic',
        ));

        return $pdf->stream('laporan-tempat-sampah.pdf');
    }
}
