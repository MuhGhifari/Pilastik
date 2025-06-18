<?php

use App\Http\Controllers\RatingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrashBinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectorController;

Route::get('/test', [TestController::class, 'show'])->name('test.show');

Route::get('/', function () {
	if (!Auth::check()) {
		return redirect()->route('login');
	}

	$user = Auth::user();
	if($user->role == 'admin') {
		return redirect()->route('admin.index');
	} elseif ($user->role == 'collector') {
		return redirect()->route('collector.index');
	} elseif($user->role == 'resident') {
		return redirect()->route('resident.index');
	} else {
		abort(403);
	}

})->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
	Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('role:admin');
	Route::get('/dashboard', [AdminController::class, 'dashboardPage'])->name('admin.dashboard')->middleware('role:admin');

	Route::get('/users', [AdminController::class, 'usersPage'])->name('admin.users')->middleware('role:admin');
	Route::get('/users/add', [AdminController::class, 'addUser'])->name('admin.add.user')->middleware('role:admin');
	Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.edit.user')->middleware('role:admin');
	Route::post('/users', [UserController::class, 'store'])->name('user.store')->middleware('role:admin');
	Route::post('/users/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('role:admin');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware('role:admin');
	
	Route::get('/trash-bins', [AdminController::class, 'trashBinsPage'])->name('admin.trash_bins')->middleware('role:admin');
	Route::get('/trash-bins/add', [AdminController::class, 'addTrashBin'])->name('admin.add.trash_bin')->middleware('role:admin');
	Route::get('/trash-bins/edit/{id}', [AdminController::class, 'editTrashBin'])->name('admin.edit.trash_bin')->middleware('role:admin');
	Route::post('/trash-bins', [TrashBinController::class, 'store'])->name('trash_bin.store')->middleware('role:admin');
	Route::post('/trash-bins/update/{id}', [TrashBinController::class, 'update'])->name('trash_bin.update')->middleware('role:admin');
	Route::delete('/trash-bins/{id}', [TrashBinController::class, 'destroy'])->name('trash_bin.delete')->middleware('role:admin');
	
	Route::get('/vehicles', [AdminController::class, 'vehiclesPage'])->name('admin.vehicles')->middleware('role:admin');
	Route::get('/vehicles/add', [AdminController::class, 'addTrashBin'])->name('admin.add.trash_bin')->middleware('role:admin');
	Route::get('/vehicles/edit/{id}', [AdminController::class, 'editTrashBin'])->name('admin.edit.vehicle')->middleware('role:admin');
	Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicle.store')->middleware('role:admin');
	Route::post('/vehicles/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update')->middleware('role:admin');
	Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicle.delete')->middleware('role:admin');
	
	Route::get('/schedules', [AdminController::class, 'schedulesPage'])->name('admin.schedules')->middleware('role:admin');
	Route::get('/schedules/add', [AdminController::class, 'addTrashBin'])->name('admin.add.trash_bin')->middleware('role:admin');
	Route::get('/schedules/edit/{id}', [AdminController::class, 'editTrashBin'])->name('admin.edit.schedule')->middleware('role:admin');
	Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedule.store')->middleware('role:admin');
	Route::post('/schedules/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update')->middleware('role:admin');
	Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedule.delete')->middleware('role:admin');
});

Route::prefix('collector')->group(function () {
	Route::get('/', [CollectorController::class, 'index'])->name('collector.index')->middleware('role:collector');
	Route::get('/collection-run', [CollectorController::class, 'collectionRunPage'])->name('collector.collection_run')->middleware('role:collector');
	Route::get('/map', [CollectorController::class, 'collectorMap'])->name('collector.map')->middleware('role:collector');
	Route::get('/trash-bin/{id}/penilaian', [CollectorController::class, 'ratingPage'])->name('collector.rating')->middleware('role:collector');
	ROute::post('/trash-bin/penilaian', [RatingController::class, 'store'])->name('rating.store')->middleware('role:collector');

});

// Route::prefix('collector')->group(function () {
// 	Route::get('/', function () {
// 		return view('collector.home');
// 	})->name('collector.index');
// });

Route::prefix('resident')->group(function () {
	Route::get('/', function () {
		return view('resident.home');
	})->name('resident.home');
});