<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use Illuminate\Http\Request;

class BeritaPublikController extends Controller
{
    public function index(Request $request)
    {
        $item = ProfilItem::findBySlug('berita');
        $query = Berita::with('sampul')
            ->where('status', 'Publish');

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $query->where('kategori', $request->input('category'));
        }

        // Filter pencarian kata kunci
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            if ($search !== '') {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('judul', 'like', "%{$search}%")
                        ->orWhere('konten', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%");
                });
            }
        }

        // Paginate hasil sebanyak 9 berita per halaman
        $beritas = $query->latest()->paginate(9)->withQueryString();

        // Ambil 2 artikel teratas sebagai Pin Post
        $pinned = Berita::with('sampul')
            ->where('status', 'Publish')
            ->latest()
            ->take(2)
            ->get();

        // Ambil 2 artikel berikutnya sebagai Artikel Terpopuler
        $popular = Berita::with('sampul')
            ->where('status', 'Publish')
            ->latest()
            ->skip(2)
            ->take(2)
            ->get();

        return view('user.berita.index', compact('beritas', 'item', 'pinned', 'popular'));
    }

    public function show(string $slug)
    {
        $berita = Berita::with('gambars')
            ->where('status', 'Publish')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('user.berita.show', compact('berita'));
    }
}
