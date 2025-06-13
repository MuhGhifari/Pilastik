<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/dashboard', 'AdminController@dashboardPage')->name('admin.dashboard');
    Route::get('/users', 'AdminController@usersPage')->name('admin.users');
    Route::get('/trash-bins', 'AdminController@trashBinsPage')->name('admin.trash_bins');
    Route::get('/vehicles', 'AdminController@vehiclesPage')->name('admin.vehicles');
    Route::get('/schedules', 'AdminController@schedulesPage')->name('admin.schedules');
});

Route::prefix('collector')->group(function () {
    Route::get('/', function () {
        return view('collector.home');
    })->name('collector.home');
});

Route::prefix('resident')->group(function () {
    Route::get('/', function () {
        return view('resident.home');
    })->name('resident.home');
});