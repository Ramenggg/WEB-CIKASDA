<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlbumKegiatan;
use App\Models\BookletDigital;
use App\Models\FotoKegiatan;
use App\Models\VideoDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // =========================================================================
    // PUBLIC FACING — halaman pengunjung
    // =========================================================================

    public function userFotoIndeks()
    {
        $albums = AlbumKegiatan::with('fotos')->latest()->get();
        return view('pages.galeri.galeri-foto', compact('albums'));
    }

    public function userVideoIndeks()
    {
        $videos = VideoDokumentasi::latest()->get();
        return view('pages.galeri.galeri-video', compact('videos'));
    }

    public function userBookletIndeks()
    {
        $booklets = BookletDigital::latest()->get();
        return view('pages.galeri.booklet-digital', compact('booklets'));
    }

    // =========================================================================
    // ADMIN — kelola foto kegiatan
    // =========================================================================

    public function adminFotoTambah()
    {
        $albums = AlbumKegiatan::with('fotos')->latest()->get();
        return view('admin.galeri.foto-tambah', compact('albums'));
    }

    public function adminFotoSimpan(Request $request)
    {
        $request->validate([
            'judul_album'      => 'required|string|max:255',
            'deskripsi_album'  => 'nullable|string',
            'foto_kegiatan'    => 'required|array',
            'foto_kegiatan.*'  => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'keterangan_foto'  => 'nullable|array',
        ]);

        $album = AlbumKegiatan::create([
            'judul_album'     => $request->judul_album,
            'deskripsi_album' => $request->deskripsi_album,
        ]);

        foreach ($request->file('foto_kegiatan') as $index => $fileFoto) {
            if ($fileFoto->isValid()) {
                $path       = $fileFoto->store('galeri', 'public');
                $keterangan = $request->keterangan_foto[$index] ?? pathinfo($fileFoto->getClientOriginalName(), PATHINFO_FILENAME);

                FotoKegiatan::create([
                    'album_kegiatan_id' => $album->id,
                    'path_foto'         => $path,
                    'keterangan_foto'   => trim($keterangan) ?: pathinfo($fileFoto->getClientOriginalName(), PATHINFO_FILENAME),
                ]);
            }
        }

        return redirect()->route('admin.galeri.foto.tambah')->with('success', 'Album foto kegiatan berhasil diterbitkan!');
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
        return redirect()->route('admin.galeri.foto.tambah')->with('success', 'Album kegiatan berhasil dihapus!');
    }

    // =========================================================================
    // ADMIN — kelola video dokumentasi
    // =========================================================================

    public function adminVideoTambah()
    {
        $videos = VideoDokumentasi::latest()->get();
        return view('admin.galeri.video-tambah', compact('videos'));
    }

    public function adminVideoSimpan(Request $request)
    {
        $request->validate([
            'judul_video'    => 'required|string|max:255',
            'deskripsi_video'=> 'nullable|string',
            'url_youtube'    => 'nullable|required_without:file_video|url',
            'file_video'     => 'nullable|required_without:url_youtube|mimes:mp4,mov,avi,mkv|max:102400',
        ]);

        $videoId   = null;
        $videoPath = null;

        if ($request->hasFile('file_video') && $request->file('file_video')->isValid()) {
            $videoPath = $request->file('file_video')->store('videos', 'public');
        } elseif ($request->filled('url_youtube')) {
            $url = $request->url_youtube;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                $videoId = $match[1];
            }
            if (empty($videoId)) {
                return redirect()->back()->withInput()->with('error', 'Format URL YouTube tidak valid!');
            }
        }

        VideoDokumentasi::create([
            'judul_video'    => $request->judul_video,
            'deskripsi_video'=> $request->deskripsi_video,
            'url_youtube'    => $videoId,
            'file_video'     => $videoPath,
        ]);

        return redirect()->route('admin.galeri.video.tambah')->with('success', 'Video dokumentasi berhasil diterbitkan!');
    }

    public function adminVideoDestroy($id)
    {
        $video = VideoDokumentasi::findOrFail($id);

        if ($video->file_video && Storage::disk('public')->exists($video->file_video)) {
            Storage::disk('public')->delete($video->file_video);
        }

        $video->delete();
        return redirect()->route('admin.galeri.video.tambah')->with('success', 'Video dokumentasi berhasil dihapus!');
    }

    // =========================================================================
    // ADMIN — kelola booklet / brosur digital
    // =========================================================================

    public function adminBookletTambah()
    {
        $booklets = BookletDigital::latest()->get();
        return view('admin.galeri.booklet-tambah', compact('booklets'));
    }

    public function adminBookletSimpan(Request $request)
    {
        $request->validate([
            'judul_booklet'    => 'required|string|max:255',
            'deskripsi_booklet'=> 'nullable|string',
            'file_pdf'         => 'nullable|required_without:url_external|mimes:pdf|max:51200',
            'url_external'     => 'nullable|required_without:file_pdf|url',
        ]);

        $pdfPath = null;

        if ($request->hasFile('file_pdf') && $request->file('file_pdf')->isValid()) {
            $pdfPath = $request->file('file_pdf')->store('booklets', 'public');
        }

        BookletDigital::create([
            'judul_booklet'    => $request->judul_booklet,
            'deskripsi_booklet'=> $request->deskripsi_booklet,
            'file_pdf'         => $pdfPath,
            'url_external'     => $request->url_external,
        ]);

        return redirect()->route('admin.galeri.booklet.tambah')->with('success', 'Booklet digital berhasil diterbitkan!');
    }

    public function adminBookletDestroy($id)
    {
        $booklet = BookletDigital::findOrFail($id);

        if ($booklet->file_pdf && Storage::disk('public')->exists($booklet->file_pdf)) {
            Storage::disk('public')->delete($booklet->file_pdf);
        }

        $booklet->delete();
        return redirect()->route('admin.galeri.booklet.tambah')->with('success', 'Booklet digital berhasil dihapus!');
    }
}
