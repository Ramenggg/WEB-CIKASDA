<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use App\Models\AlbumKegiatan;
use App\Models\VideoDokumentasi;
use App\Models\BookletDigital;
use App\Models\Pesan;
use Illuminate\Http\Request;

class ProfilPublikController extends Controller
{
    public function struktur()
    {
        $item = ProfilItem::findBySlug('struktur');
        return view('pages.profil.struktur-organisasi', compact('item'));
    }

    public function visiMisi()
    {
        $item = ProfilItem::findBySlug('visi-misi');
        return view('pages.profil.visi-misi', compact('item'));
    }

    public function tugasFungsi()
    {
        $item = ProfilItem::findBySlug('tugas-fungsi');
        return view('pages.profil.tugas-fungsi', compact('item'));
    }

    public function sejarah()
    {
        $item = ProfilItem::findBySlug('sejarah');
        return view('pages.profil.sejarah', compact('item'));
    }

    public function pejabat()
    {
        $item = ProfilItem::findBySlug('pejabat');
        return view('pages.profil.pejabat', compact('item'));
    }

    public function maklumat()
    {
        $item = ProfilItem::findBySlug('maklumat');
        return view('pages.profil.maklumat', compact('item'));
    }

    public function lhkpn()
    {
        $item = ProfilItem::findBySlug('lhkpn');
        return view('pages.profil.lhkpn', compact('item'));
    }

    public function keuangan()
    {
        $item = ProfilItem::findBySlug('keuangan');
        return view('pages.profil.keuangan', compact('item'));
    }

    public function beritaIndeks()
    {
        $beritas = Berita::with('sampul')
            ->where('status', 'Publish')
            ->latest()
            ->take(9)
            ->get();

        return view('user.berita.index', compact('beritas'));
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

    public function publikasi()
    {
        $item = ProfilItem::findBySlug('publikasi');
        return view('pages.informasi.publikasi-informasi', compact('item'));
    }

    public function dokumen()
    {
        $item = ProfilItem::findBySlug('dokumen');
        return view('pages.informasi.dokumen', compact('item'));
    }

    public function mou()
    {
        $item = ProfilItem::findBySlug('mou');
        return view('pages.informasi.mou', compact('item'));
    }

    public function formPermohonan()
    {
        $item = ProfilItem::findBySlug('form-permohonan');
        return view('pages.informasi.form-permohonan', compact('item'));
    }

    public function skGub()
    {
        $item = ProfilItem::findBySlug('sk-gub');
        return view('pages.informasi.sk-gub', compact('item'));
    }

    public function formAduan()
    {
        $item = ProfilItem::findBySlug('form-aduan');
        return view('pages.informasi.form-aduan-masyarakat', compact('item'));
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
