<?php

namespace App\Http\Controllers;

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
    public function index() {
        return redirect()->route('admin.dashboard');
    }

    public function dashboardPage() {
        $totalUsers = User::count();
        $totalDropOffLocations = DropOffLocation::count();
        $totalSchedules = Schedule::count();
        $totalVehicles = Vehicle::count();
        $totalTrashBins = TrashBin::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDropOffLocations',
            'totalSchedules',
            'totalVehicles',
            'totalTrashBins'
        ));
    }

    public function trashBinsPage() {
        $trashBins = TrashBin::all();
        return view('admin.trash_bins', compact('trashBins'));
    }

    public function usersPage() {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function vehiclesPage() {
        $vehicles = Vehicle::all();
        return view('admin.vehicles', compact('vehicles'));
    }

    public function schedulesPage() {
        $schedules = Schedule::all();
        return view('admin.schedules', compact('schedules'));
    }

}
