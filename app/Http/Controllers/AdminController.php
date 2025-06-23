<?php

namespace App\Http\Controllers;

use App\Models\PickupLog;
use DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\DropOffLocation;
use App\Models\Schedule;
use App\Models\Vehicle;
use App\Models\TrashBin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    public function dashboardPage()
    {
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
        // dd($weeklyWaste);
        // $binTypeSummary = PickupLog::join('trash_bins', 'pickup_logs.trash_bin_id', '=', 'trash_bins.id')
        //     ->selectRaw("bin_type, SUM(weight) as total")
        //     ->groupBy('bin_type')
        //     ->pluck('total', 'bin_type');

        // $totalToday = Schedule::whereDate('scheduled_time', now())->count();
        // $completedToday = PickupLog::whereDate('created_at', now())->count();
        // $progress = $totalToday > 0 ? round(($completedToday / $totalToday) * 100) : 0;

        // $topResidents = PickupLog::join('trash_bins', 'pickup_logs.trash_bin_id', '=', 'trash_bins.id')
        //     ->join('users', 'trash_bins.resident_id', '=', 'users.id')
        //     ->selectRaw('users.name, SUM(weight) as total_weight')
        //     ->groupBy('users.name')
        //     ->orderByDesc('total_weight')
        //     ->limit(5)
        //     ->get();

        // $trashBins = TrashBin::select('latitude', 'longitude', 'status', 'id')->get();
        
        $totalTrashBins = TrashBin::all()->count();
        $totalCollectedBins = TrashBin::where('status', 'collected')->count();
        $progressPercentage = $totalTrashBins > 0 ? round(($totalCollectedBins / $totalTrashBins) * 100) : 0;

        $totalUsers = User::count();
        $totalDropOffLocations = DropOffLocation::count();
        $totalSchedules = Schedule::count();
        $totalVehicles = Vehicle::count();
        $totalTrashBins = TrashBin::count();
        $trashBins = TrashBin::all();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDropOffLocations',
            'totalSchedules',
            'totalVehicles',
            'totalTrashBins',
            'weeklyWaste',
            'trashBins',
            'totalTrashBins',
            'totalCollectedBins',
            'progressPercentage',
            'totalOrganic',
            'totalInorganic',
        ));
    }

    public function trashBinsPage()
    {
        $trashBins = DB::table('trash_bins')
            ->leftJoin('users as residents', 'trash_bins.resident_id', '=', 'residents.id')
            ->leftJoin('schedules', 'trash_bins.id', '=', 'schedules.trash_bin_id')
            ->leftJoin('users as collectors', 'schedules.collector_id', '=', 'collectors.id')
            ->select(
                'trash_bins.*',
                'residents.name as resident',
                'residents.address as resident_address',
                'residents.phone as resident_phone',
                'collectors.name as collector'
            )
            ->get();
        $residents = User::where('role', 'resident')->get();

        // dd($test);
        return view('admin.trash_bins', compact(['trashBins', 'residents']));
    }

    public function usersPage()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function addUser()
    {
        return view('admin.add_user');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.edit_user', compact(['user']));
    }

    public function vehiclesPage()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles', compact('vehicles'));
    }

    public function schedulesPage()
    {
        $schedules = Schedule::all();
        return view('admin.schedules', compact('schedules'));
    }

}
