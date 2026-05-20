<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Inputan
        $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|string',
            'status'   => 'required|string',
            'images'   => 'required|array', // Wajib upload minimal 1 gambar
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072' // Max 3MB per file
        ]);

        // 2. Simpan Data Teks Berita ke Tabel 'beritas'
        $berita = Berita::create([
            'judul'    => $request->judul,
            'slug'     => Str::slug($request->judul) . '-' . time(), // slug otomatis unik (contoh: berita-a-17182922)
            'konten'   => $request->konten,
            'kategori' => $request->kategori,
            'status'   => $request->status,
        ]);

        // 3. Proses Upload Banyak Gambar Berdasarkan Urutan Drag-and-Drop Admin
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                // Simpan file ke folder storage/app/public/berita
                $path = $file->store('berita', 'public');

                // Simpan ke tabel 'berita_gambars' lengkap dengan nomor urutannya ($index)
                BeritaGambar::create([
                    'berita_id' => $berita->id,
                    'file_path' => $path,
                    'urutan'    => $index // Index 0 otomatis jadi sampul utama!
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Berita ciamik Anda berhasil diterbitkan!');
    }
}