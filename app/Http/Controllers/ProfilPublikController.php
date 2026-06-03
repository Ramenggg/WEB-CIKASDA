<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use App\Models\AlbumKegiatan; // FIX KUNCI: Panggil model album untuk galeri foto di sini!

class ProfilPublikController extends Controller
{
    /**
     * 1. Tampilkan halaman Struktur Organisasi ke publik.
     * GET /profil/struktur-organisasi
     */
    public function struktur()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'struktur']);
        return view('pages.profil.struktur-organisasi', compact('item'));
    }

    /**
     * 2. Tampilkan halaman Visi & Misi ke publik.
     * GET /profil/visi-misi
     */
    public function visiMisi()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'visi-misi']);
        return view('pages.profil.visi-misi', compact('item'));
    }

    /**
     * 3. Tampilkan halaman Tugas & Fungsi ke publik.
     * GET /profil/tugas-fungsi
     */
    public function tugasFungsi()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'tugas-fungsi']);
        return view('pages.profil.tugas-fungsi', compact('item'));
    }

    /**
     * 4. Tampilkan halaman Sejarah Singkat ke publik.
     * GET /profil/sejarah-singkat
     */
    public function sejarah()
    {
        // KUNCI: Menarik data dengan slug 'sejarah' dari database
        $item = ProfilItem::firstOrNew(['slug' => 'sejarah']);
        return view('pages.profil.sejarah', compact('item'));
    }

    /**
     * 5. Tampilkan halaman Pejabat ke publik.
     * GET /profil/pejabat
     */
    public function pejabat()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'pejabat']);
        return view('pages.profil.pejabat', compact('item'));
    }

    /**
     * 6. Tampilkan halaman Maklumat Informasi Publik ke publik.
     * GET /profil/maklumat-informasi-publik
     */
    public function maklumat()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'maklumat']);
        return view('pages.profil.maklumat', compact('item'));
    }

    /**
     * 7. Tampilkan halaman LHKPN ke publik.
     * GET /profil/lhkpn
     */
    public function lhkpn()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'lhkpn']);
        return view('pages.profil.lhkpn', compact('item'));
    }

    /**
     * 8. Tampilkan halaman Keuangan ke publik.
     * GET /profil/keuangan
     */
    public function keuangan()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'keuangan']);
        return view('pages.profil.keuangan', compact('item'));
    }

    /**
     * Tampilkan Indeks Berita Instansi CIKASDA.
     * GET /profil/berita-instansi
     */
    public function beritaIndeks()
    {
        // Ambil berita yang statusnya 'Publish', bawa relasi 'sampul' (Eager Loading),
        // urutkan dari yang paling baru, lalu batasi maksimal 9 berita
        $beritas = Berita::with('sampul')->where('status', 'Publish')->latest()->take(9)->get();

        // Oper data berita ke file blade milik user
        return view('user.berita.index', compact('beritas'));
    }

    /**
     * ==================================================================
     * FIX KUNCI: Tampilkan Galeri Foto Kegiatan ke Pengunjung / Publik
     * GET /profil/galeri-foto
     * ==================================================================
     */
    public function fotoIndeks()
    {
        // Ambil semua data album, sertakan data foto di dalamnya, urutkan dari yang terbaru
        $albums = AlbumKegiatan::with('fotos')->latest()->get();

        // Lempar data ke lokasi file target view user yang sudah kamu konfirmasi
        return view('pages.galeri.galeri-foto', compact('albums'));
    }
}
