<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenyewaanController;

// Route Utama
Route::get('/', [KendaraanController::class, 'index'])->name('home');

// Route CRUD Kendaraan
Route::resource('kendaraan', KendaraanController::class);

// Route Penyewaan
Route::get('/sewa/{kendaraan}', [PenyewaanController::class, 'create'])
    ->name('sewa.create')
    ->where('kendaraan', '[0-9]+');

Route::post('/sewa', [PenyewaanController::class, 'store'])
    ->name('sewa.store');