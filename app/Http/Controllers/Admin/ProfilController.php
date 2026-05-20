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
     * KUNCI: Sudah lengkap dari urutan 1 sampai 8 sesuai kebutuhan Dinas CIKASDA!
     */
    private array $halamanValid = [
        'struktur' => 'Struktur Organisasi',
        'visi-misi' => 'Visi dan Misi',
        'tugas-fungsi' => 'Tugas dan Fungsi',
        'sejarah' => 'Sejarah Singkat',
        'pejabat' => 'Pejabat',
        'maklumat' => 'Maklumat Informasi Publik',
        'lhkpn' => 'LHKPN',
        'keuangan' => 'Keuangan',
    ];

    /**
     * Tampilkan form edit untuk halaman profil tertentu.
     * GET /admin/profil/{halaman}
     */
    public function edit(string $halaman)
    {
        // Validasi slug agar tidak sembarang halaman bisa diakses
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $item = ProfilItem::firstOrNew(['slug' => $halaman]);
        $judul = $this->halamanValid[$halaman];

        // Otomatis mengarah ke file view masing-masing, contoh: profil.visi_misi
        return view('admin.profil.' . str_replace('-', '_', $halaman), compact('item', 'judul'));
    }

    /**
     * Simpan perubahan konten halaman profil (Google Form Style - Nullable).
     * POST /admin/profil/{halaman}
     */
    public function update(Request $request, string $halaman)
    {
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $request->validate([
            'konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $item = ProfilItem::firstOrNew(['slug' => $halaman]);
        $item->slug = $halaman;
        $item->judul = $this->halamanValid[$halaman];

        // ==================================================================
        // LOGIKA BARU: INTERSEPSI PERINTAH HAPUS GANDA DARI VIEW FORM
        // ==================================================================
        if ($request->filled('target_hapus')) {
            $target = $request->input('target_hapus');

            if ($target === 'text') {
                $item->konten = null; // Kosongkan narasi di DB
                $pesanSukses = 'Komponen Teks Visi Misi berhasil dihapus!';
            } elseif ($target === 'image' && $item->gambar_path) {
                Storage::disk('public')->delete($item->gambar_path); // Hapus fisik gambar di Supabase
                $item->gambar_path = null; // Set null di DB
                $pesanSukses = 'Berkas Gambar Infografis berhasil dimusnahkan dari server!';
            } elseif ($target === 'pdf' && $item->pdf_path) {
                Storage::disk('public')->delete($item->pdf_path); // Hapus fisik PDF di Supabase
                $item->pdf_path = null; // Set null di DB
                $pesanSukses = 'Dokumen lampiran PDF resmi berhasil dihapus permanen!';
            }

            $item->save();
            return redirect()->route('admin.profil.edit', $halaman)->with('success', $pesanSukses);
        }

        // --- Logika Penyimpanan Normal Bawaan Kemarin ---
        $item->konten = $request->input('konten');

        if ($request->hasFile('gambar')) {
            if ($item->gambar_path) {
                Storage::disk('public')->delete($item->gambar_path);
            }
            $item->gambar_path = $request->file('gambar')->store('profil', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($item->pdf_path) {
                Storage::disk('public')->delete($item->pdf_path);
            }
            $item->pdf_path = $request->file('pdf_file')->store('profil/dokumen', 'public');
        }

        $item->save();

        return redirect()
            ->route('admin.profil.edit', $halaman)
            ->with('success', 'Konten "' . $this->halamanValid[$halaman] . '" berhasil diperbarui!');
    }
}
