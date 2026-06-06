<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Tampilkan daftar berita untuk panel admin.
     * GET /admin/berita
     */
    public function adminIndex()
    {
        $beritas = Berita::with('sampul')->latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Tampilkan form pembuatan berita.
     * GET /admin/berita/tambah
     */
    public function create()
    {
        return view('admin.berita.tambah');
    }

    /**
     * Simpan berita baru.
     * POST /admin/berita/simpan
     */
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
        $disk = $this->getDisk();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                // Simpan file ke folder storage/app/public/berita
                $path = $file->store('berita', $disk);

                // Simpan ke tabel 'berita_gambars' lengkap dengan nomor urutannya ($index)
                BeritaGambar::create([
                    'berita_id' => $berita->id,
                    'file_path' => $path,
                    'urutan'    => $index // Index 0 otomatis jadi sampul utama!
                ]);
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita ciamik Anda berhasil diterbitkan!');
    }

    /**
     * Tampilkan form edit berita.
     * GET /admin/berita/{id}/edit
     */
    public function edit($id)
    {
        $berita = Berita::with('gambars')->findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Perbarui berita yang sudah ada.
     * PUT /admin/berita/{id}/update
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|string',
            'status'   => 'required|string',
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'delete_images'   => 'nullable|array',
            'delete_images.*' => 'integer'
        ]);

        // Update data teks
        $berita->update([
            'judul'    => $request->judul,
            'slug'     => $berita->judul !== $request->judul ? Str::slug($request->judul) . '-' . time() : $berita->slug,
            'konten'   => $request->konten,
            'kategori' => $request->kategori,
            'status'   => $request->status,
        ]);

        $disk = $this->getDisk();

        // 1. Hapus gambar yang dicentang admin
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $gambar = BeritaGambar::where('berita_id', $berita->id)->find($imgId);
                if ($gambar) {
                    Storage::disk($disk)->delete($gambar->file_path);
                    $gambar->delete();
                }
            }
        }

        // 2. Unggah gambar tambahan jika ada
        if ($request->hasFile('images')) {
            $maxUrutan = BeritaGambar::where('berita_id', $berita->id)->max('urutan') ?? -1;
            foreach ($request->file('images') as $file) {
                $maxUrutan++;
                $path = $file->store('berita', $disk);
                BeritaGambar::create([
                    'berita_id' => $berita->id,
                    'file_path' => $path,
                    'urutan'    => $maxUrutan
                ]);
            }
        }

        // 3. Urutkan ulang sisa gambar agar index 0 selalu terisi sebagai sampul utama
        $remaining = BeritaGambar::where('berita_id', $berita->id)->orderBy('urutan')->get();
        foreach ($remaining as $index => $gambar) {
            $gambar->update(['urutan' => $index]);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Hapus berita beserta seluruh gambarnya.
     * DELETE /admin/berita/{id}/hapus
     */
    public function destroy($id)
    {
        $berita = Berita::with('gambars')->findOrFail($id);
        $disk = $this->getDisk();

        // Hapus file fisik gambar dan entri database
        foreach ($berita->gambars as $gambar) {
            Storage::disk($disk)->delete($gambar->file_path);
            $gambar->delete();
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita beserta seluruh dokumentasinya berhasil dihapus!');
    }

    /**
     * Tentukan disk penyimpanan aktif berdasarkan konfigurasi FILESYSTEM_DISK.
     * Mengembalikan 'supabase' jika dikonfigurasi, fallback ke 'public' (local).
     */
    private function getDisk(): string
    {
        return config('filesystems.default') === 'supabase' ? 'supabase' : 'public';
    }
}