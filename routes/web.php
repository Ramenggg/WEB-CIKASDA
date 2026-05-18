<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\ProfilPublikController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Website CIKASDA
|--------------------------------------------------------------------------
*/

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// --------------------------------------------------------
// Rute Halaman Profil Publik (Akses Pengunjung)
// --------------------------------------------------------
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/struktur-organisasi', [ProfilPublikController::class, 'struktur'])->name('struktur');
    Route::get('/visi-misi', [ProfilPublikController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/tugas-fungsi', [ProfilPublikController::class, 'tugasFungsi'])->name('tugas-fungsi');
    
    // Tambahkan menu publik lainnya di sini jika diperlukan
});

// --------------------------------------------------------
// Rute Panel Admin (Pusat Kendali)
// --------------------------------------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Baru: Log Aktivitas (Sesuai permintaan agar tombol bisa diklik)
    Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');

    // Kelola Konten Profil (Dinamis: Struktur, Visi-Misi, Keuangan, dll)
    Route::get('/profil/{halaman}', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/{halaman}', [ProfilController::class, 'update'])->name('profil.update');

    // Tempatkan rute manajemen berita/galeri di sini nanti
});

// --------------------------------------------------------
// Rute Autentikasi & User Profile (Bawaan Laravel)
// --------------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.user'); // Diubah agar tidak bentrok dengan admin.dashboard

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';