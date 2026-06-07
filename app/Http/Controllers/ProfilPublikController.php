<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use App\Models\Pesan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAduanRequest;
use App\Services\FileService;

class ProfilPublikController extends Controller
{
    private array $pageMappings = [
        // Profil
        'struktur'        => 'pages.profil.struktur-organisasi',
        'visi-misi'       => 'pages.profil.visi-misi',
        'tugas-fungsi'    => 'pages.profil.tugas-fungsi',
        'sejarah'         => 'pages.profil.sejarah',
        'pejabat'         => 'pages.profil.pejabat',
        'maklumat'        => 'pages.profil.maklumat',
        'lhkpn'           => 'pages.profil.lhkpn',
        'keuangan'        => 'pages.profil.keuangan',
        // Informasi Publik
        'publikasi'       => 'pages.informasi.publikasi-informasi',
        'dokumen'         => 'pages.informasi.dokumen',
        'mou'             => 'pages.informasi.mou',
        'form-permohonan' => 'pages.informasi.form-permohonan',
        'sk-gub'          => 'pages.informasi.sk-gub',
        'form-aduan'      => 'pages.informasi.form-aduan-masyarakat',
        // PPID
        'ppid-sk'              => 'PPID.surat-keputusan',
        'ppid-visi-misi'       => 'PPID.visi-misi',
        'ppid-pelayanan'       => 'PPID.pelayanan',
        'ppid-penghargaan'     => 'PPID.penghargaan',
        'ppid-permohonan'      => 'PPID.permohonan-informasi',
        'ppid-dokumen-program' => 'PPID.dokumen-elektronik',
        'ppid-sop-spm'         => 'PPID.sop-spm',
    ];

    public function showPage(string $slug)
    {
        abort_unless(array_key_exists($slug, $this->pageMappings), 404);
        
        $item = ProfilItem::findBySlug($slug);
        $view = $this->pageMappings[$slug];
        
        return view($view, compact('item'));
    }

    public function beritaIndeks()
    {
        $beritas = Berita::with('sampul')
            ->where('status', 'Publish')
            ->latest()
            ->take(9)
            ->get();

        $item = new ProfilItem(); // Dummy item to prevent x-profil-hero errors
        
        return view('user.berita.index', compact('beritas', 'item'));
    }

    public function daftarInformasi()
    {
        $item = ProfilItem::findBySlug('daftar-informasi');
        $informationGroups = \App\Models\InformationGroup::with('items')->get()->map(function($group) {
            return [
                'id' => $group->id,
                'category' => $group->category,
                'num' => $group->num,
                'title' => $group->title,
                'items' => $group->items->map(function($sub) {
                    return [
                        'title' => $sub->title,
                        'detail' => $sub->detail,
                        'link' => $sub->link,
                        'type' => $sub->type,
                        'status' => $sub->status,
                        'dasar_hukum' => $sub->dasar_hukum
                    ];
                })
            ];
        });
        return view('pages.informasi.daftar-informasi', compact('item', 'informationGroups'));
    }

    public function storeAduan(StoreAduanRequest $request, FileService $fileService)
    {
        $validated = $request->validated();

        // Handle KTP file upload using FileService
        $ktpPath = $fileService->upload($request->file('ktp'), 'aduan', 'ktp');

        // Handle Bukti Dukung file upload using FileService
        $buktiPath = null;
        if ($request->hasFile('bukti_dukung')) {
            $buktiPath = $fileService->upload($request->file('bukti_dukung'), 'aduan', 'bukti');
        }

        // Format message to combine all details without DB migration
        $formattedMessage = "ALAMAT:\n" . $validated['alamat'] . "\n\n";
        $formattedMessage .= "NOMOR HP / WHATSAPP:\n" . $validated['no_hp'] . "\n\n";
        $formattedMessage .= "DESKRIPSI ADUAN:\n" . $validated['pesan'] . "\n\n";
        
        if ($ktpPath) {
            $formattedMessage .= "BERKAS KTP/SIM:\n" . $fileService->url($ktpPath) . "\n\n";
        }
        if ($buktiPath) {
            $formattedMessage .= "BUKTI DUKUNG:\n" . $fileService->url($buktiPath) . "\n";
        }

        Pesan::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'subjek' => 'Aduan Masyarakat: ' . substr($validated['pesan'], 0, 50) . '...',
            'pesan' => $formattedMessage,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Aduan dan laporan Anda berhasil dikirim ke Dinas CIKASDA.');
    }
}
