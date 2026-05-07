<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\ProfilPublikController;
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// --------------------------------------------------------
// Rute Halaman Profil Publik (terhubung ke database)
// --------------------------------------------------------
Route::prefix('profil')->group(function () {
    Route::get('/struktur-organisasi', [ProfilPublikController::class, 'struktur'])->name('profil.struktur');
    Route::get('/visi-misi', [ProfilPublikController::class, 'visiMisi'])->name('profil.visi-misi');
    Route::get('/tugas-fungsi', [ProfilPublikController::class, 'tugasFungsi'])->name('profil.tugas-fungsi');
});

// --------------------------------------------------------
// Rute Panel Admin
// --------------------------------------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Konten Profil (Edit & Simpan)
    Route::get('/profil/{halaman}', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/{halaman}', [ProfilController::class, 'update'])->name('profil.update');

});

// Rute Dashboard & Autentikasi (Bawaan Laravel)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';