<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use App\Models\Pesan;
use Illuminate\Http\Request;

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

    public function showPage($slug)
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

    public function storeAduan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:1000',
            'no_hp' => 'required|string|max:20',
            'pesan' => 'required|string',
            'ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'bukti_dukung' => 'nullable|file|mimes:jpeg,png,jpg,pdf,zip,rar,doc,docx,xls,xlsx|max:10240',
        ]);

        // Ensure target folder exists
        if (!file_exists(public_path('uploads/aduan'))) {
            mkdir(public_path('uploads/aduan'), 0755, true);
        }

        // Handle KTP file upload
        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $filename = 'ktp_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/aduan'), $filename);
            $ktpPath = '/uploads/aduan/' . $filename;
        }

        // Handle Bukti Dukung file upload
        $buktiPath = null;
        if ($request->hasFile('bukti_dukung')) {
            $file = $request->file('bukti_dukung');
            $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/aduan'), $filename);
            $buktiPath = '/uploads/aduan/' . $filename;
        }

        // Format message to combine all details without DB migration
        $formattedMessage = "ALAMAT:\n" . $validated['alamat'] . "\n\n";
        $formattedMessage .= "NOMOR HP / WHATSAPP:\n" . $validated['no_hp'] . "\n\n";
        $formattedMessage .= "DESKRIPSI ADUAN:\n" . $validated['pesan'] . "\n\n";
        
        if ($ktpPath) {
            $formattedMessage .= "BERKAS KTP/SIM:\n" . asset($ktpPath) . "\n\n";
        }
        if ($buktiPath) {
            $formattedMessage .= "BUKTI DUKUNG:\n" . asset($buktiPath) . "\n";
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
