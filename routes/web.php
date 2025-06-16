<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
	Route::get('/users', [AdminController::class, 'usersPage'])->name('admin.users');
	Route::get('/trash-bins', [AdminController::class, 'trashBinsPage'])->name('admin.trash_bins');
	Route::get('/vehicles', [AdminController::class, 'vehiclesPage'])->name('admin.vehicles');
	Route::get('/schedules', [AdminController::class, 'schedulesPage'])->name('admin.schedules');
});

Route::prefix('collector')->group(function () {
	Route::get('/', 'CollectorController@index')->name('collector.index');
	Route::get('/home', 'CollectorController@dashboardPage')->name('collector.home');
	Route::get('/users', 'CollectorController@usersPage')->name('collector.users');
	Route::get('/trash-bins', 'CollectorController@trashBinsPage')->name('collector.trash_bins');
	Route::get('/vehicles', 'CollectorController@vehiclesPage')->name('collector.vehicles');
	Route::get('/schedules', 'CollectorController@schedulesPage')->name('collector.schedules');
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