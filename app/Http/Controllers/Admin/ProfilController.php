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
        'struktur'     => 'Struktur Organisasi',
        'visi-misi'    => 'Visi dan Misi',
        'tugas-fungsi' => 'Tugas dan Fungsi',
        'sejarah'      => 'Sejarah Singkat',
        'pejabat'      => 'Pejabat',
        'maklumat'     => 'Maklumat Informasi Publik',
        'lhkpn'        => 'LHKPN & LHKASN',
        'keuangan'     => 'Keuangan',
        'sekilas-dinas'=> 'Data Sekilas Dinas',
        'daftar-informasi'=> 'Daftar Informasi',
        'publikasi'    => 'Publikasi Informasi',
        'dokumen'      => 'Dokumen',
        'mou'          => 'Perjanjian Kerja Sama (MoU)',
        'form-permohonan' => 'Kelola Permohonan Publik',
        'sk-gub'       => 'SK GUB Bangunan Gedung 2025',
        'form-aduan'   => 'Form Aduan Masyarakat',
        'ppid-sk'      => 'SK PPID',
        'ppid-visi-misi' => 'Visi & Misi PPID',
        'ppid-pelayanan' => 'Standar Pelayanan PPID',
        'ppid-penghargaan' => 'Penghargaan PPID',
        'ppid-permohonan' => 'Prosedur Permohonan PPID',
        'ppid-dokumen-program' => 'Dokumen Elektronik PPID',
        'ppid-sop-spm' => 'SOP & SPM PPID',
    ];

    /**
     * Tampilkan form edit.
     * GET /admin/profil/{halaman}
     */
    public function edit(string $halaman)
    {
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $item  = ProfilItem::firstOrNew(['slug' => $halaman]);
        $judul = $this->halamanValid[$halaman];

        if (str_starts_with($halaman, 'ppid-')) {
            $viewPrefix = 'admin.PPID.';
        } elseif (in_array($halaman, ['dokumen', 'mou', 'form-permohonan', 'sk-gub', 'form-aduan'])) {
            $viewPrefix = 'admin.informasi.';
        } else {
            $viewPrefix = 'admin.profil.';
        }

        return view($viewPrefix . str_replace('-', '_', $halaman), compact('item', 'judul'));
    }

    /**
     * Simpan perubahan halaman profil.
     * POST /admin/profil/{halaman}
     */
    public function update(Request $request, string $halaman)
    {
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

        $disk = $this->getDisk();

        // ── VALIDASI DINAMIS ───────────────────────────────────────────────
        $rules = [
            'konten'           => 'nullable|string',
            'hero_description' => 'nullable|string',
            'pdf_file'         => 'nullable|mimes:pdf|max:51200',
            'pdf_file_2'       => 'nullable|mimes:pdf|max:51200',
            'pdf_file_3'       => 'nullable|mimes:pdf|max:51200',
        ];

        if ($halaman === 'keuangan') {
            $rules['gambar']   = 'nullable|file|mimes:pdf|max:5120';
            $rules['gambar_2'] = 'nullable|file|mimes:pdf|max:5120';
        } else {
            $rules['gambar']   = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
            $rules['gambar_2'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
        }

        $request->validate($rules);

        $item  = ProfilItem::firstOrNew(['slug' => $halaman]);
        $item->slug  = $halaman;
        $item->judul = $this->halamanValid[$halaman];
        $label = $this->halamanValid[$halaman];

        // ── HAPUS KOMPONEN (double-confirm dari view) ──────────────────────
        if ($request->filled('target_hapus')) {
            $target      = $request->input('target_hapus');
            $pesanSukses = 'Komponen berhasil dihapus.';

            if ($target === 'text') {
                $item->content_data = null;
                $pesanSukses = "Konten teks \"{$label}\" berhasil dihapus!";
            } elseif ($target === 'image' && $item->primary_image_path) {
                Storage::disk($disk)->delete($item->primary_image_path);
                $item->primary_image_path = null;
                $pesanSukses = "Gambar utama \"{$label}\" berhasil dihapus dari server!";
            } elseif ($target === 'image_2' && $item->secondary_image_path) {
                Storage::disk($disk)->delete($item->secondary_image_path);
                $item->secondary_image_path = null;
                $pesanSukses = "Gambar kedua \"{$label}\" berhasil dihapus dari server!";
            } elseif ($target === 'pdf' && $item->primary_document_path) {
                Storage::disk($disk)->delete($item->primary_document_path);
                $item->primary_document_path = null;
                $pesanSukses = "Dokumen PDF \"{$label}\" berhasil dihapus permanen!";
            } elseif ($target === 'pdf_2' && $item->secondary_document_path) {
                Storage::disk($disk)->delete($item->secondary_document_path);
                $item->secondary_document_path = null;
                $pesanSukses = "Dokumen PDF kedua \"{$label}\" berhasil dihapus permanen!";
            } elseif ($target === 'pdf_3' && $item->extra_document_path) {
                Storage::disk($disk)->delete($item->extra_document_path);
                $item->extra_document_path = null;
                $pesanSukses = "Dokumen PDF ketiga \"{$label}\" berhasil dihapus permanen!";
            }

            $item->save();
            $isInformasi = in_array($halaman, ['dokumen', 'mou', 'form-permohonan', 'sk-gub', 'form-aduan']);
            $redirectRoute = $halaman === 'daftar-informasi'
                ? route('admin.informasi.daftar.edit')
                : ($halaman === 'publikasi' ? route('admin.informasi.publikasi.edit') : ($isInformasi ? route('admin.informasi.edit', $halaman) : route('admin.profil.edit', $halaman)));
            return redirect($redirectRoute)->with('success', $pesanSukses);
        }

        // ── SIMPAN KONTEN UTAMA ────────────────────────────────────────────
        if ($halaman === 'pejabat') {
            $biografiKadis = $request->input('biografi_kadis');
            $biografiSekretaris = $request->input('biografi_sekretaris');
            
            $item->content_data = json_encode([
                'nama_kadis'          => $request->input('nama_kadis'),
                'biografi_kadis'      => ($biografiKadis && trim(strip_tags($biografiKadis)) !== '') ? $biografiKadis : null,
                'nama_sekretaris'     => $request->input('nama_sekretaris'),
                'biografi_sekretaris' => ($biografiSekretaris && trim(strip_tags($biografiSekretaris)) !== '') ? $biografiSekretaris : null,
            ]);
        } elseif ($halaman === 'sekilas-dinas') {
            $item->content_data = json_encode([
                'jumlah_bidang'    => $request->input('jumlah_bidang'),
                'jumlah_subbagian' => $request->input('jumlah_subbagian'),
                'jumlah_upt'       => $request->input('jumlah_upt'),
                'total_pegawai'    => $request->input('total_pegawai'),
                'tahun_dibentuk'   => $request->input('tahun_dibentuk'),
            ]);
        } else {
            // General case for pages using Quill (Visi Misi, Struktur, Sejarah, dsb)
            $item->content_data = $request->input('konten');
        }

        // ── HERO DESCRIPTION (semua halaman) ──────────────────────────────
        $heroVal = $request->input('hero_description');
        $item->hero_description = ($heroVal && trim(strip_tags($heroVal)) !== '') ? $heroVal : null;

        // ── UPLOAD GAMBAR UTAMA ────────────────────────────────────────────
        if ($request->hasFile('gambar')) {
            if ($item->primary_image_path) {
                Storage::disk($disk)->delete($item->primary_image_path);
            }
            $file = $request->file('gambar');
            $folder = $file->extension() === 'pdf' ? 'profil/dokumen' : 'profil';
            $item->primary_image_path = $file->store($folder, $disk);
        }

        // ── UPLOAD GAMBAR KEDUA ────────────────────────────────────────────
        if ($request->hasFile('gambar_2')) {
            if ($item->secondary_image_path) {
                Storage::disk($disk)->delete($item->secondary_image_path);
            }
            $file = $request->file('gambar_2');
            $folder = $file->extension() === 'pdf' ? 'profil/dokumen' : 'profil';
            $item->secondary_image_path = $file->store($folder, $disk);
        }

        // ── UPLOAD PDF UTAMA ───────────────────────────────────────────────
        if ($request->hasFile('pdf_file')) {
            if ($item->primary_document_path) {
                Storage::disk($disk)->delete($item->primary_document_path);
            }
            $item->primary_document_path = $request->file('pdf_file')->store('profil/dokumen', $disk);
        }

        // ── UPLOAD PDF KEDUA ───────────────────────────────────────────────
        if ($request->hasFile('pdf_file_2')) {
            if ($item->secondary_document_path) {
                Storage::disk($disk)->delete($item->secondary_document_path);
            }
            $item->secondary_document_path = $request->file('pdf_file_2')->store('profil/dokumen', $disk);
        }

        // ── UPLOAD PDF KETIGA (Accordion 5 Keuangan) ──────────────────────
        if ($request->hasFile('pdf_file_3')) {
            if ($item->extra_document_path) {
                Storage::disk($disk)->delete($item->extra_document_path);
            }
            $item->extra_document_path = $request->file('pdf_file_3')->store('profil/dokumen', $disk);
        }

        $item->save();

        $isInformasi = in_array($halaman, ['dokumen', 'mou', 'form-permohonan', 'sk-gub', 'form-aduan']);
        $isPpid = str_starts_with($halaman, 'ppid-');

        if ($halaman === 'daftar-informasi') {
            $redirectRoute = route('admin.informasi.daftar.edit');
        } elseif ($halaman === 'publikasi') {
            $redirectRoute = route('admin.informasi.publikasi.edit');
        } elseif ($isPpid) {
            $redirectRoute = route('admin.ppid.edit', str_replace('ppid-', '', $halaman));
        } elseif ($isInformasi) {
            $redirectRoute = route('admin.informasi.edit', $halaman);
        } else {
            $redirectRoute = route('admin.profil.edit', $halaman);
        }

        return redirect($redirectRoute)->with('success', "Konten \"{$label}\" berhasil diperbarui!");
    }

    /**
     * Tentukan disk penyimpanan aktif berdasarkan konfigurasi FILESYSTEM_DISK.
     * Mengembalikan 'supabase' jika dikonfigurasi, fallback ke 'public' (local).
     */
    private function getDisk(): string
    {
        return config('filesystems.default') === 'supabase' ? 'supabase' : 'public';
    }

    public function editDaftar()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'daftar-informasi']);
        $judul = $this->halamanValid['daftar-informasi'];
        $informationGroups = \App\Models\InformationGroup::with('items')->orderBy('category')->orderBy('num')->get();
        return view('admin.informasi.daftar_informasi', compact('item', 'judul', 'informationGroups'));
    }

    public function updateDaftar(Request $request)
    {
        return $this->update($request, 'daftar-informasi');
    }

    public function editPublikasi()
    {
        $halaman = 'publikasi';
        $item  = ProfilItem::firstOrNew(['slug' => $halaman]);
        $judul = $this->halamanValid[$halaman];
        return view('admin.informasi.publikasi', compact('item', 'judul'));
    }

    public function updatePublikasi(Request $request)
    {
        return $this->update($request, 'publikasi');
    }
}
