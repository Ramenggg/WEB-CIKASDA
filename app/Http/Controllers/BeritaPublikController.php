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

        $beritas = $query->latest()->get();

        return view('user.berita.index', compact('beritas', 'item'));
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
