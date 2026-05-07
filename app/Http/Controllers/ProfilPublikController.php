<?php

namespace App\Http\Controllers;

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
}
