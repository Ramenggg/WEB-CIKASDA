<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;

class ProfilPublikController extends Controller
{
    /**
     * Tampilkan halaman Struktur Organisasi ke publik.
     * GET /profil/struktur-organisasi
     */
    public function struktur()
    {
        $item = ProfilItem::findBySlug('struktur');
        return view('pages.profil.struktur-organisasi', compact('item'));
    }

    /**
     * Tampilkan halaman Visi & Misi ke publik.
     * GET /profil/visi-misi
     */
    public function visiMisi()
    {
        $item = ProfilItem::findBySlug('visi-misi');
        return view('pages.profil.visi-misi', compact('item'));
    }

    /**
     * Tampilkan halaman Tugas & Fungsi ke publik.
     * GET /profil/tugas-fungsi
     */
    public function tugasFungsi()
    {
        $item = ProfilItem::findBySlug('tugas-fungsi');
        return view('pages.profil.tugas-fungsi', compact('item'));

    }
    public function beritaIndeks()
    {
        // Ambil berita yang statusnya 'Publish', bawa relasi 'sampul' (Eager Loading),
        // urutkan dari yang paling baru, lalu batasi maksimal 9 berita (bisa pakai paginate jika mau)
        $beritas = Berita::with('sampul')
            ->where('status', 'Publish')
            ->latest()
            ->take(9)
            ->get();

        // Oper data berita ke file blade milik user
        return view('user.berita.index', compact('beritas')); // berita
    }
}
