<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilItem;
use App\Models\AlbumKegiatan;
use App\Models\VideoDokumentasi;
use App\Models\BookletDigital;

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
}
