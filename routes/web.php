<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ActivityLogController;

Route::get('/dashboard', function () {
    return redirect()->route('aspirasi.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/tambah', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::patch('/aspirasi/{aspirasi}', [AspirasiController::class, 'update'])->name('aspirasi.update');

    Route::get('/aspirasi/riwayat', [AspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');
    Route::delete('/aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

    Route::get('/siswa', [AspirasiController::class, 'siswa'])->name('siswa.index');
    Route::get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('log_aktivitas.index');
});

require __DIR__.'/auth.php';
