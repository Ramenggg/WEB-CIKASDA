<?php

namespace App\Http\Controllers\Admin; // FIX KUNCI: Sekarang resmi masuk folder Admin!

use App\Http\Controllers\Controller; // Wajib di-import karena posisi di dalam sub-folder
use Illuminate\Http\Request;
use App\Models\AlbumKegiatan;
use App\Models\FotoKegiatan;
use App\Models\VideoDokumentasi;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // ==========================================================================
    // SEKSI A: SISI PENGUNJUNG / USER / PUBLIK
    // ==========================================================================

    // 1. Indeks Galeri Foto User
    public function userFotoIndeks()
    {
        $albums = AlbumKegiatan::with('fotos')->latest()->get();
        return view('pages.galeri.galeri-foto', compact('albums'));
    }

    // 2. Indeks Galeri Video User
    public function userVideoIndeks()
    {
        $videos = VideoDokumentasi::latest()->get();
        return view('pages.galeri.galeri-video', compact('videos'));
    }

    // 3. Indeks Booklet User
    public function userBookletIndeks()
    {
        $booklets = \App\Models\BookletDigital::latest()->get();
        return view('pages.galeri.booklet-digital', compact('booklets'));
    }

    // ==========================================================================
    // SEKSI B: SISI BACKEND / ADMIN / MANAGEMENT
    // ==========================================================================

    // --- SUB-MENU 1: KELOLA FOTO KEGIATAN ---
    public function adminFotoTambah()
    {
        $albums = AlbumKegiatan::with('fotos')->latest()->get();
        return view('admin.galeri.foto-tambah', compact('albums'));
    }

    public function adminFotoSimpan(Request $request)
    {
        $request->validate([
            'judul_album' => 'required|string|max:255',
            'deskripsi_album' => 'nullable|string',
            'foto_kegiatan' => 'required|array',
            'foto_kegiatan.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'keterangan_foto' => 'nullable|array',
        ]);

        $album = AlbumKegiatan::create([
            'judul_album' => $request->judul_album,
            'deskripsi_album' => $request->deskripsi_album,
        ]);

        $daftarFoto = $request->file('foto_kegiatan');
        $daftarKeterangan = $request->keterangan_foto;

        if (!empty($daftarFoto)) {
            foreach ($daftarFoto as $index => $fileFoto) {
                if ($fileFoto->isValid()) {
                    $path = $fileFoto->store('galeri', 'public');

                    if (isset($daftarKeterangan[$index]) && trim($daftarKeterangan[$index]) !== '') {
                        $keterangan = $daftarKeterangan[$index];
                    } else {
                        $keterangan = pathinfo($fileFoto->getClientOriginalName(), PATHINFO_FILENAME);
                    }

                    FotoKegiatan::create([
                        'album_kegiatan_id' => $album->id,
                        'path_foto' => $path,
                        'keterangan_foto' => $keterangan,
                    ]);
                }
            }
        }
        return redirect()->route('admin.galeri.foto.tambah')->with('success', 'Album foto kegiatan baru berhasil diterbitkan!');
    }

    public function adminFotoDestroy($id)
    {
        $album = AlbumKegiatan::findOrFail($id);
        foreach ($album->fotos as $foto) {
            if (Storage::disk('public')->exists($foto->path_foto)) {
                Storage::disk('public')->delete($foto->path_foto);
            }
        }
        $album->delete();
        return redirect()->route('admin.galeri.foto.tambah')->with('success', 'Album kegiatan berhasil dihapus dari arsip!');
    }

    // --- SUB-MENU 2: KELOLA VIDEO DOKUMENTASI ---
    public function adminVideoTambah()
    {
        $videos = VideoDokumentasi::latest()->get();
        return view('admin.galeri.video-tambah', compact('videos'));
    }

    public function adminVideoSimpan(Request $request)
    {
        // Validasi cerdas: Salah satu antara link YouTube atau File Video WAJIB diisi
        $request->validate([
            'judul_video' => 'required|string|max:255',
            'deskripsi_video' => 'nullable|string',
            'url_youtube' => 'nullable|required_without:file_video|url',
            'file_video' => 'nullable|required_without:url_youtube|mimes:mp4,mov,avi,mkv|max:102400', // Batas Maksimal 100MB
        ]);

        $videoId = null;
        $videoPath = null;

        // OPSI A: Jika Admin Mengunggah File Video Fisik Lapangan
        if ($request->hasFile('file_video')) {
            $file = $request->file('file_video');
            if ($file->isValid()) {
                $videoPath = $file->store('videos', 'public');
            }
        }
        // OPSI B: Jika Admin Memasukkan Tautan Link YouTube
        elseif ($request->filled('url_youtube')) {
            $url = $request->url_youtube;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                $videoId = $match[1];
            }
            if (empty($videoId)) {
                return redirect()->back()->withInput()->with('error', 'Format URL YouTube tidak valid!');
            }
        }

        VideoDokumentasi::create([
            'judul_video' => $request->judul_video,
            'deskripsi_video' => $request->deskripsi_video,
            'url_youtube' => $videoId,
            'file_video' => $videoPath,
        ]);

        return redirect()->route('admin.galeri.video.tambah')->with('success', 'Konten multimedia video berhasil diterbitkan!');
    }

    public function adminVideoDestroy($id)
    {
        $video = VideoDokumentasi::findOrFail($id);

        // Bersihkan file video fisik dari storage lokal jika ada sebelum dihapus
        if ($video->file_video && Storage::disk('public')->exists($video->file_video)) {
            Storage::disk('public')->delete($video->file_video);
        }

        $video->delete();
        return redirect()->route('admin.galeri.video.tambah')->with('success', 'Video dokumentasi berhasil dihapus dari arsip!');
    }

    // --- SUB-MENU 3: KELOLA BOOKLET / BROSUR DIGITAL ---
    public function adminBookletTambah()
    {
        // Ambil data dari model BookletDigital baru
        $booklets = \App\Models\BookletDigital::latest()->get();
        return view('admin.galeri.booklet-tambah', compact('booklets'));
    }

    public function adminBookletSimpan(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'judul_booklet' => 'required|string|max:255',
            'deskripsi_booklet' => 'nullable|string',
            'file_pdf' => 'nullable|required_without:url_external|mimes:pdf|max:51200', // Maksimal 50MB PDF
            'url_external' => 'nullable|required_without:file_pdf|url',
        ]);

        $pdfPath = null;

        // Proses jika mengunggah file PDF fisik dinas
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            if ($file->isValid()) {
                $pdfPath = $file->store('booklets', 'public');
            }
        }

        \App\Models\BookletDigital::create([
            'judul_booklet' => $request->judul_booklet,
            'deskripsi_booklet' => $request->deskripsi_booklet,
            'file_pdf' => $pdfPath,
            'url_external' => $request->url_external,
        ]);

        return redirect()->route('admin.galeri.booklet.tambah')->with('success', 'Dokumen booklet / brosur digital baru berhasil diterbitkan!');
    }

    public function adminBookletDestroy($id)
    {
        $booklet = \App\Models\BookletDigital::findOrFail($id);

        // Bersihkan berkas PDF fisik dari local storage sebelum dihapus dari DB
        if ($booklet->file_pdf && \Illuminate\Support\Facades\Storage::disk('public')->exists($booklet->file_pdf)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($booklet->file_pdf);
        }

        $booklet->delete();
        return redirect()->route('admin.galeri.booklet.tambah')->with('success', 'Dokumen booklet berhasil dihapus dari arsip dinas!');
    }
}
