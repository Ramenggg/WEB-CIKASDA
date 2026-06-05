<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\BeritaPublikController;
use App\Http\Controllers\ProfilPublikController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Website CIKASDA
|--------------------------------------------------------------------------
*/

// ==========================================================================
// 1. LANDING PAGE
// ==========================================================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==========================================================================
// 2. HALAMAN PUBLIK - PROFIL DINAS
// ==========================================================================

Route::prefix('profil')->name('profil.')->group(function () {

    // Menu: Profil Dinas
    Route::get('/sejarah',              [ProfilPublikController::class, 'sejarah']    )->name('sejarah');
    Route::get('/visi-misi',            [ProfilPublikController::class, 'visiMisi']   )->name('visi-misi');
    Route::get('/tugas-fungsi',         [ProfilPublikController::class, 'tugasFungsi'])->name('tugas-fungsi');
    Route::get('/struktur-organisasi',  [ProfilPublikController::class, 'struktur']   )->name('struktur');
    Route::get('/pejabat',              [ProfilPublikController::class, 'pejabat']    )->name('pejabat');

    // Menu: Transparansi & Informasi Publik
    Route::get('/lhkpn',    [ProfilPublikController::class, 'lhkpn']   )->name('lhkpn');
    Route::get('/keuangan', [ProfilPublikController::class, 'keuangan'])->name('keuangan');
    Route::get('/maklumat', [ProfilPublikController::class, 'maklumat'])->name('maklumat');

});

Route::get('/daftar-informasi', [ProfilPublikController::class, 'daftarInformasi'])->name('daftar-informasi');
Route::get('/informasi/publikasi', [ProfilPublikController::class, 'publikasi'])->name('informasi.publikasi');

// Halaman Unduh Klasifikasi Informasi Publik (Redirect to unified page for compatibility)
Route::get('/daftar-informasi-publik-setiap-saat', function() {
    return redirect()->route('daftar-informasi', ['tab' => 'setiapsaat']);
});
Route::get('/daftar-informasi-publik-serta-merta', function() {
    return redirect()->route('daftar-informasi', ['tab' => 'sertamerta']);
});
Route::get('/daftar-informasi-publik-berkala', function() {
    return redirect()->route('daftar-informasi', ['tab' => 'berkala']);
});
Route::get('/daftar-informasi-dikecualikan', function() {
    return redirect()->route('daftar-informasi', ['tab' => 'dikecualikan']);
});
Route::get('/daftar-informasi-dikecualikan-2', function() {
    return redirect()->route('daftar-informasi', ['tab' => 'dikecualikan']);
});

// ==========================================================================
// 3. HALAMAN PUBLIK - BERITA
// ==========================================================================

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/',       [BeritaPublikController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaPublikController::class, 'show'] )->name('show');
});

// ==========================================================================
// 4. HALAMAN PUBLIK - GALERI & MULTIMEDIA
// ==========================================================================

Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/foto',             [GaleriController::class, 'userFotoIndeks']   )->name('foto');
    Route::get('/video',            [GaleriController::class, 'userVideoIndeks']  )->name('video');
    Route::get('/booklet-digital',  [GaleriController::class, 'userBookletIndeks'])->name('booklet');
});

// ==========================================================================
// 5. PANEL ADMIN (AUTH REQUIRED)
// ==========================================================================

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // --- Dashboard & Logs ---
    Route::get('/',     [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logs', [DashboardController::class, 'logs'] )->name('logs');

    // --- Kelola Konten Profil Dinamis ---
    Route::get( '/profil/{halaman}', [ProfilController::class, 'edit']  )->name('profil.edit');
    Route::post('/profil/{halaman}', [ProfilController::class, 'update'])->name('profil.update');

    // --- Kelola Berita ---
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/',             [BeritaController::class, 'adminIndex'])->name('index');
        Route::get('/tambah',       [BeritaController::class, 'create']   )->name('tambah');
        Route::post('/simpan',      [BeritaController::class, 'store']    )->name('simpan');
        Route::get('/{id}/edit',    [BeritaController::class, 'edit']     )->name('edit');
        Route::put('/{id}/update',  [BeritaController::class, 'update']   )->name('update');
        Route::delete('/{id}/hapus',[BeritaController::class, 'destroy']  )->name('hapus');
    });

    // --- Kelola Galeri Foto ---
    Route::prefix('galeri-foto')->name('galeri.foto.')->group(function () {
        Route::get('/',             [GaleriController::class, 'adminFotoTambah'] )->name('index');
        Route::post('/simpan',      [GaleriController::class, 'adminFotoSimpan'] )->name('simpan');
        Route::post('/kategori/hapus', [GaleriController::class, 'adminFotoKategoriHapus'])->name('kategori.hapus');
        Route::delete('/{id}/hapus',[GaleriController::class, 'adminFotoDestroy'])->name('hapus');
    });

    // --- Kelola Galeri Video ---
    Route::prefix('galeri-video')->name('galeri.video.')->group(function () {
        Route::get('/',             [GaleriController::class, 'adminVideoTambah'] )->name('index');
        Route::post('/simpan',      [GaleriController::class, 'adminVideoSimpan'] )->name('simpan');
        Route::delete('/{id}/hapus',[GaleriController::class, 'adminVideoDestroy'])->name('hapus');
    });

    // --- Kelola Booklet Digital ---
    Route::prefix('galeri-booklet')->name('galeri.booklet.')->group(function () {
        Route::get('/',             [GaleriController::class, 'adminBookletTambah'] )->name('index');
        Route::post('/simpan',      [GaleriController::class, 'adminBookletSimpan'] )->name('simpan');
        Route::delete('/{id}/hapus',[GaleriController::class, 'adminBookletDestroy'])->name('hapus');
    });

});

// ==========================================================================
// 6. AUTENTIKASI & PROFIL USER (LARAVEL BREEZE)
// ==========================================================================

Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get(   '/profile', [ProfileController::class, 'edit']   )->name('profile.edit');
    Route::patch( '/profile', [ProfileController::class, 'update'] )->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';