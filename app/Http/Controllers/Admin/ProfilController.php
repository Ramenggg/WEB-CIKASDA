<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Daftar halaman profil yang valid.
     * Kunci = slug URL, Nilai = label tampilan
     */
    private array $halamanValid = [
        'struktur'    => 'Struktur Organisasi',
        'visi-misi'   => 'Visi & Misi',
        'tugas-fungsi' => 'Tugas & Fungsi',
    ];

    /**
     * Tampilkan form edit untuk halaman profil tertentu.
     * GET /admin/profil/{halaman}
     */
    public function edit(string $halaman)
    {
        // Validasi slug agar tidak sembarang halaman bisa diakses
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $item  = ProfilItem::findBySlug($halaman);
        $judul = $this->halamanValid[$halaman];

        return view('admin.profil.' . str_replace('-', '_', $halaman), compact('item', 'judul'));
    }

    /**
     * Simpan perubahan konten halaman profil.
     * POST /admin/profil/{halaman}
     */
    public function update(Request $request, string $halaman)
    {
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $request->validate([
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Ambil atau buat record baru
        $item = ProfilItem::firstOrNew(['slug' => $halaman]);
        $item->slug  = $halaman;
        $item->judul = $this->halamanValid[$halaman];

        if ($request->filled('konten')) {
            $item->konten = $request->input('konten');
        }

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($item->gambar_path) {
                Storage::disk('public')->delete($item->gambar_path);
            }

            $path = $request->file('gambar')->store('profil', 'public');
            $item->gambar_path = $path;
        }

        $item->save();

        return redirect()
            ->route('admin.profil.edit', $halaman)
            ->with('success', 'Konten "' . $this->halamanValid[$halaman] . '" berhasil diperbarui!');
    }
}
