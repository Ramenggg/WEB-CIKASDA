<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaGambar;
use Illuminate\Support\Str;

use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Services\FileService;

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
    public function store(StoreBeritaRequest $request, FileService $fileService)
    {
        $validated = $request->validated();

        // 1. Simpan Data Teks Berita ke Tabel 'beritas'
        $berita = Berita::create([
            'judul'    => $validated['judul'],
            'slug'     => Str::slug($validated['judul']) . '-' . time(),
            'konten'   => $validated['konten'],
            'kategori' => $validated['kategori'],
            'status'   => $validated['status'],
        ]);

        // 2. Proses Upload Banyak Gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $fileService->upload($file, 'berita');

                BeritaGambar::create([
                    'berita_id' => $berita->id,
                    'file_path' => $path,
                    'urutan'    => $index
                ]);
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita ciamik Anda berhasil diterbitkan!');
    }

    /**
     * Tampilkan form edit berita.
     * GET /admin/berita/{id}/edit
     */
    public function edit(string $id)
    {
        $berita = Berita::with('gambars')->findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Perbarui berita yang sudah ada.
     * PUT /admin/berita/{id}/update
     */
    public function update(UpdateBeritaRequest $request, FileService $fileService, string $id)
    {
        $berita = Berita::findOrFail($id);
        $validated = $request->validated();

        // Update data teks
        $berita->update([
            'judul'    => $validated['judul'],
            'slug'     => $berita->judul !== $validated['judul'] ? Str::slug($validated['judul']) . '-' . time() : $berita->slug,
            'konten'   => $validated['konten'],
            'kategori' => $validated['kategori'],
            'status'   => $validated['status'],
        ]);

        // 1. Hapus gambar yang dicentang admin
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $gambar = BeritaGambar::where('berita_id', $berita->id)->find($imgId);
                if ($gambar) {
                    $fileService->delete($gambar->file_path);
                    $gambar->delete();
                }
            }
        }

        // 2. Unggah gambar tambahan jika ada
        if ($request->hasFile('images')) {
            $maxUrutan = BeritaGambar::where('berita_id', $berita->id)->max('urutan') ?? -1;
            foreach ($request->file('images') as $file) {
                $maxUrutan++;
                $path = $fileService->upload($file, 'berita');
                BeritaGambar::create([
                    'berita_id' => $berita->id,
                    'file_path' => $path,
                    'urutan'    => $maxUrutan
                ]);
            }
        }

        // 3. Urutkan ulang sisa gambar
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
    public function destroy(FileService $fileService, string $id)
    {
        $berita = Berita::with('gambars')->findOrFail($id);

        // Hapus file fisik gambar dan entri database
        foreach ($berita->gambars as $gambar) {
            $fileService->delete($gambar->file_path);
            $gambar->delete();
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita beserta seluruh dokumentasinya berhasil dihapus!');
    }
}