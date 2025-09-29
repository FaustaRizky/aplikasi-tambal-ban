<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LakuController;
use App\Http\Controllers\KulaanController;

// Route default ketika pertama kali buka website
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Kalau kamu mau tetap punya view statis bisa juga langsung return view
// Route::get('/', function () {
//     return view('dashboard.index');
// });

Route::resource('dashboard', DashboardController::class);
Route::resource('barangs', BarangController::class);
Route::resource('lakus', LakuController::class);
Route::resource('kulaans', KulaanController::class);
