<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilItem;
use Illuminate\Http\Request;
use App\Services\FileService;

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
    public function update(Request $request, FileService $fileService, string $halaman)
    {
        abort_unless(array_key_exists($halaman, $this->halamanValid), 404);

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

        // ── HAPUS KOMPONEN ─────────────────────────────────────────────────
        if ($request->filled('target_hapus')) {
            $target      = $request->input('target_hapus');
            $pesanSukses = 'Komponen berhasil dihapus.';

            $mappings = [
                'text'    => 'content_data',
                'image'   => 'primary_image_path',
                'image_2' => 'secondary_image_path',
                'pdf'     => 'primary_document_path',
                'pdf_2'   => 'secondary_document_path',
                'pdf_3'   => 'extra_document_path',
            ];

            if (isset($mappings[$target])) {
                $field = $mappings[$target];
                if ($field !== 'content_data' && $item->$field) {
                    $fileService->delete($item->$field);
                }
                $item->$field = null;
                $pesanSukses = "Komponen \"{$target}\" untuk \"{$label}\" berhasil dihapus!";
            }

            $item->save();
            return redirect($this->getRedirectRoute($halaman))->with('success', $pesanSukses);
        }

        // ── SIMPAN KONTEN UTAMA ────────────────────────────────────────────
        if ($halaman === 'pejabat') {
            $biografiKadis = $request->input('biografi_kadis');
            $biografiSekretaris = $request->input('biografi_sekretaris');
            
            $item->content_data = [
                'nama_kadis'          => $request->input('nama_kadis'),
                'biografi_kadis'      => ($biografiKadis && trim(strip_tags($biografiKadis)) !== '') ? $biografiKadis : null,
                'nama_sekretaris'     => $request->input('nama_sekretaris'),
                'biografi_sekretaris' => ($biografiSekretaris && trim(strip_tags($biografiSekretaris)) !== '') ? $biografiSekretaris : null,
            ];
        } elseif ($halaman === 'sekilas-dinas') {
            $item->content_data = [
                'jumlah_bidang'    => $request->input('jumlah_bidang'),
                'jumlah_subbagian' => $request->input('jumlah_subbagian'),
                'jumlah_upt'       => $request->input('jumlah_upt'),
                'total_pegawai'    => $request->input('total_pegawai'),
                'tahun_dibentuk'   => $request->input('tahun_dibentuk'),
            ];
        } else {
            $item->content_data = $request->input('konten');
        }

        // ── HERO DESCRIPTION ──────────────────────────────────────────────
        $heroVal = $request->input('hero_description');
        $item->hero_description = ($heroVal && trim(strip_tags($heroVal)) !== '') ? $heroVal : null;

        // ── UPLOAD FILES ──────────────────────────────────────────────────
        $fileMappings = [
            'gambar'     => 'primary_image_path',
            'gambar_2'   => 'secondary_image_path',
            'pdf_file'   => 'primary_document_path',
            'pdf_file_2' => 'secondary_document_path',
            'pdf_file_3' => 'extra_document_path',
        ];

        foreach ($fileMappings as $requestKey => $dbField) {
            if ($request->hasFile($requestKey)) {
                if ($item->$dbField) {
                    $fileService->delete($item->$dbField);
                }
                $file = $request->file($requestKey);
                $folder = (str_contains($requestKey, 'pdf') || $file->extension() === 'pdf') ? 'profil/dokumen' : 'profil';
                $item->$dbField = $fileService->upload($file, $folder);
            }
        }

        $item->save();

        return redirect($this->getRedirectRoute($halaman))->with('success', "Konten \"{$label}\" berhasil diperbarui!");
    }

    private function getRedirectRoute(string $halaman): string
    {
        $isInformasi = in_array($halaman, ['dokumen', 'mou', 'form-permohonan', 'sk-gub', 'form-aduan']);
        $isPpid = str_starts_with($halaman, 'ppid-');

        if ($halaman === 'daftar-informasi') {
            return route('admin.informasi.daftar.edit');
        } elseif ($halaman === 'publikasi') {
            return route('admin.informasi.publikasi.edit');
        } elseif ($isPpid) {
            return route('admin.ppid.edit', str_replace('ppid-', '', $halaman));
        } elseif ($isInformasi) {
            return route('admin.informasi.edit', $halaman);
        } else {
            return route('admin.profil.edit', $halaman);
        }
    }

    public function editDaftar()
    {
        $item = ProfilItem::firstOrNew(['slug' => 'daftar-informasi']);
        $judul = $this->halamanValid['daftar-informasi'];
        $informationGroups = \App\Models\InformationGroup::with('items')->orderBy('category')->orderBy('num')->get();
        return view('admin.informasi.daftar_informasi', compact('item', 'judul', 'informationGroups'));
    }

    public function updateDaftar(Request $request, FileService $fileService)
    {
        return $this->update($request, $fileService, 'daftar-informasi');
    }

    public function editPublikasi()
    {
        $halaman = 'publikasi';
        $item  = ProfilItem::firstOrNew(['slug' => $halaman]);
        $judul = $this->halamanValid[$halaman];
        return view('admin.informasi.publikasi', compact('item', 'judul'));
    }

    public function updatePublikasi(Request $request, FileService $fileService)
    {
        return $this->update($request, $fileService, 'publikasi');
    }
}
