<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AdminController,
    AuthController,
    CollectorController,
    CollectionRunController,
    RatingController,
    ScheduleController,
    TestController,
    TrashBinController,
    UserController,
    VehicleController,
		ResidentController
};

// Test Route
Route::get('/test', [TestController::class, 'show'])->name('test.show');
Route::get('/test/this', [TestController::class, 'test'])->name('test.this');
Route::get('/test/report', [TestController::class, 'report'])->name('test.report');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Root Route
Route::get('/', function () {
	if (!Auth::check()) return redirect()->route('login');

	$user = Auth::user();
	return match ($user->role) {
		'admin'     => redirect()->route('admin.index'),
		'collector' => redirect()->route('collector.index'),
		'resident'  => redirect()->route('resident.index'),
		default     => abort(403),
	};
})->name('index');

// Admin Routes
Route::prefix('admin')->middleware('role:admin')->group(function () {
	// Dashboard
	Route::get('/', [AdminController::class, 'index'])->name('admin.index');
	Route::get('/dashboard', [AdminController::class, 'dashboardPage'])->name('admin.dashboard');

	// Users
	Route::get('/users', [AdminController::class, 'usersPage'])->name('admin.users');
	Route::get('/users/data', [UserController::class, 'getUsers'])->name('users.data');
	Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
	Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
	Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
	
	// Trash Bins
	Route::get('/trash-bins', [AdminController::class, 'trashBinsPage'])->name('admin.trash_bins');
	Route::get('/trash-bins/data', [TrashBinController::class, 'getTrashBins'])->name('trash_bins.data');
	Route::post('/trash-bins/store', [TrashBinController::class, 'store'])->name('trash_bins.store');
	Route::post('/trash-bins/update/{id}', [TrashBinController::class, 'update'])->name('trash_bins.update');
	Route::delete('/trash-bins/delete/{id}', [TrashBinController::class, 'destroy'])->name('trash_bins.delete');

	// Vehicles
	Route::get('/vehicles', [AdminController::class, 'vehiclesPage'])->name('admin.vehicles');
	Route::get('/vehicles/add', [AdminController::class, 'addVehicle'])->name('admin.vehicles.add');
	Route::get('/vehicles/edit/{id}', [AdminController::class, 'editVehicle'])->name('admin.vehicles.edit');
	Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
	Route::post('/vehicles/update/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
	Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.delete');

	// Schedules
	Route::get('/schedules', [AdminController::class, 'schedulesPage'])->name('admin.schedules');
	Route::get('/schedules/add', [AdminController::class, 'addSchedule'])->name('admin.schedules.add');
	Route::get('/schedules/edit/{id}', [AdminController::class, 'editSchedule'])->name('admin.schedules.edit');
	Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');
	Route::post('/schedules/update/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
	Route::delete('/schedules/delete/{id}', [ScheduleController::class, 'destroy'])->name('schedules.delete');
});

// Collector Routes
Route::prefix('collector')->middleware('role:collector')->group(function () {
	Route::get('/', [CollectorController::class, 'index'])->name('collector.index');
	
	Route::get('/collection-run', [CollectorController::class, 'collectionRunPage'])->name('collector.collection_run');
	Route::post('/collection-run/begin', [CollectionRunController::class, 'beginCollectionRun'])->name('collector.collection_run.begin');
	Route::post('/collection-run/stop', [CollectionRunController::class, 'stopCollectionRun'])->name('collector.collection_run.stop');
	
	Route::get('/map', [CollectorController::class, 'collectorMap'])->name('collector.map');
	
	Route::get('/trash-bin/{id}/rate', [CollectorController::class, 'ratingPage'])->name('collector.rate');
	Route::post('/trash-bin/{id}/rate/store', [RatingController::class, 'store'])->name('rating.store');
	
	// Rating
	Route::get('/trash-bin/{id}/penilaian', [CollectorController::class, 'ratingPage'])->name('collector.rating');
	Route::post('/trash-bin/penilaian/submit', [RatingController::class, 'store'])->name('rating.store');
	
	Route::get('/drop-off', [CollectorController::class,  'dropOffPage'])->name('collector.dropoff');
	Route::post('/drop-off/{id}', [CollectorController::class,  'storeDropOff'])->name('dropoff.store');
});

Route::prefix('resident')->middleware('role:resident')->group(function () {
	Route::get('/', [ResidentController::class, 'index'])->name('resident.index');
	
});