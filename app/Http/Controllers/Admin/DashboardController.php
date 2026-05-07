<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilItem;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard admin.
     */
    public function index()
    {
        // Statistik ringkasan konten yang sudah terisi
        $stats = [
            'total_konten'    => ProfilItem::count(),
            'konten_terisi'   => ProfilItem::whereNotNull('konten')->count(),
            'konten_bergambar' => ProfilItem::whereNotNull('gambar_path')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
