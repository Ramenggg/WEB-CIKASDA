<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;   // Model untuk Artikel
use App\Models\Galeri;   // Model untuk Foto/Video
use App\Models\Pesan;    // Model untuk Pesan/Kontak
use App\Models\ActivityLog; // Model untuk Aktivitas (jika ada library log)
use App\Models\Visitor;  // Model untuk Pengunjung
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Total Data
        $countBerita = Berita::count();
        $countGaleri = Galeri::count();
        
        // 2. Pesan yang belum dibaca (is_read = false)
        $countPesan  = Pesan::where('is_read', false)->count();

        // 3. Pengunjung Hari Ini
        $countHits   = Visitor::whereDate('created_at', today())->count();

        // 4. Ambil 5 Aktivitas Terakhir
        $latestLogs  = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'countBerita', 
            'countGaleri', 
            'countPesan', 
            'countHits',
            'latestLogs'
        ));
    }

    // Fungsi untuk halaman "Lihat Semua Log"
    public function logs()
    {
        $allLogs = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.logs.index', compact('allLogs'));
    }

    // Fungsi untuk menampilkan daftar pengaduan masyarakat
    public function pesanIndex()
    {
        $pesans = Pesan::latest()->paginate(15);
        return view('admin.informasi.pesan.index', compact('pesans'));
    }

    // Fungsi untuk menandai pengaduan sebagai telah dibaca
    public function pesanRead(int $id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Aduan berhasil ditandai sebagai dibaca.');
    }

    // Fungsi untuk menghapus pengaduan
    public function pesanDestroy(int $id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();
        return redirect()->back()->with('success', 'Aduan berhasil dihapus.');
    }
}