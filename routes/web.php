<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KebijakanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportKembaliController;
use App\Http\Controllers\ReportPinjamController;
use App\Http\Controllers\TrsKembaliController;
use App\Http\Controllers\TrsPinjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('anggota', AnggotaController::class);
Route::resource('koleksi', KoleksiController::class);
Route::resource('kebijakan', KebijakanController::class);
Route::resource('trsPinjam', TrsPinjamController::class);
Route::resource('trsKembali', TrsKembaliController::class);
Route::resource('reportPinjam', ReportPinjamController::class);
Route::resource('reportKembali', ReportKembaliController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
