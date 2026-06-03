<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\ProfilPublikController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Website CIKASDA
|--------------------------------------------------------------------------
*/

// --------------------------------------------------------------------------
// 1. RUTE HALAMAN UTAMA (LANDING PAGE)
// --------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// --------------------------------------------------------------------------
// 2. RUTE HALAMAN USER / PUBLIK (AKSES PENGUNJUNG WEBSITE)
// --------------------------------------------------------------------------
Route::prefix('profil')
    ->name('profil.')
    ->group(function () {
        // --- A. KELOMPOK MENU PROFIL DINAS ---
        Route::get('/sejarah', [ProfilPublikController::class, 'sejarah'])->name('sejarah');
        Route::get('/pejabat', [ProfilPublikController::class, 'pejabat'])->name('pejabat');
        Route::get('/visi-misi', [ProfilPublikController::class, 'visiMisi'])->name('visi-misi');
        Route::get('/tugas-fungsi', [ProfilPublikController::class, 'tugasFungsi'])->name('tugas-fungsi');
        Route::get('/struktur-organisasi', [ProfilPublikController::class, 'struktur'])->name('struktur');

        // --- B. KELOMPOK MENU TRANSPARANSI & INFORMASI PUBLIK ---
        Route::get('/lhkpn', [ProfilPublikController::class, 'lhkpn'])->name('lhkpn');
        Route::get('/keuangan', [ProfilPublikController::class, 'keuangan'])->name('keuangan');
        Route::get('/maklumat', [ProfilPublikController::class, 'maklumat'])->name('maklumat');

        // --- C. KELOMPOK MENU MULTIMEDIA / GALERI CIKASDA ---
        Route::get('/galeri-foto', [GaleriController::class, 'userFotoIndeks'])->name('galeri-foto');
        Route::get('/galeri-video', [GaleriController::class, 'userVideoIndeks'])->name('galeri-video');
        Route::get('/booklet-digital', [GaleriController::class, 'userBookletIndeks'])->name('booklet');

        // --- D. KELOMPOK MENU WARTA & BERITA INSTANSI ---
        Route::get('/berita-instansi', [ProfilPublikController::class, 'beritaIndeks'])->name('berita');
    });

// --------------------------------------------------------------------------
// 3. RUTE PANEL ADMIN (PUSAT KENDALI SISTEM)
// --------------------------------------------------------------------------
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // --- A. DASHBOARD UTAMA & LOGS ---
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');

        // --- B. KELOLA KONTEN PROFIL DINAMIS ---
        Route::get('/profil/{halaman}', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/{halaman}', [ProfilController::class, 'update'])->name('profil.update');

        // --- C. KELOLA WARTA BERITA INSTANSI ---
        Route::get('/berita', function () {
            return redirect()->route('admin.berita.tambah');
        })->name('berita.index');
        Route::get('/berita/tambah', function () {
            return view('admin.berita.tambah');
        })->name('berita.tambah');
        Route::post('/berita/simpan', [BeritaController::class, 'store'])->name('berita.simpan');

        // --- D. CORE MULTIMEDIA SUB-MENU (SATU CONTROLLER UNTUK SEMUA) ---
        // Sub-Menu 1: Kelola Foto Kegiatan
        Route::get('/galeri-foto/tambah', [GaleriController::class, 'adminFotoTambah'])->name('galeri.foto.tambah');
        Route::post('/galeri-foto/simpan', [GaleriController::class, 'adminFotoSimpan'])->name('galeri.foto.simpan');
        Route::delete('/galeri-foto/hapus/{id}', [GaleriController::class, 'adminFotoDestroy'])->name('galeri.foto.hapus');

        // Sub-Menu 2: Kelola Video Dokumentasi
        Route::get('/galeri/video', [GaleriController::class, 'adminVideoTambah'])->name('galeri.video.tambah');
        Route::post('/galeri/video/simpan', [GaleriController::class, 'adminVideoSimpan'])->name('galeri.video.simpan');
        Route::delete('/galeri/video/hapus/{id}', [GaleriController::class, 'adminVideoDestroy'])->name('galeri.video.hapus');

        // Sub-Menu 3: Kelola Booklet / Brosur Digital (UPGRADED RESMI)
        Route::get('/galeri/booklet', [GaleriController::class, 'adminBookletTambah'])->name('galeri.booklet.tambah');
        Route::post('/galeri/booklet/simpan', [GaleriController::class, 'adminBookletSimpan'])->name('galeri.booklet.simpan');
        Route::delete('/galeri/booklet/hapus/{id}', [GaleriController::class, 'adminBookletDestroy'])->name('galeri.booklet.hapus');
    });

// --------------------------------------------------------------------------
// 4. RUTE AUTENTIKASI & USER PROFILE (DEFAULT AUTH LARAVEL)
// --------------------------------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Load Rute Bawaan Laravel Breeze / Jetstream Auth
require __DIR__ . '/auth.php';
