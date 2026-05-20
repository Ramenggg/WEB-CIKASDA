<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Berita extends Model
{
    protected $fillable = ['judul', 'slug', 'konten', 'kategori', 'status'];

    // Relasi ambil SEMUA gambar yang diurutkan berdasarkan urutan drag-drop admin
    public function gambars(): HasMany
    {
        return $this->hasMany(BeritaGambar::class)->orderBy('urutan', 'asc');
    }

    // Relasi khusus untuk mengambil GAMBAR SAMPUL UTAMA (urutan paling pertama / index 0)
    public function sampul(): HasOne
    {
        return $this->hasOne(BeritaGambar::class)->where('urutan', 0);
    }
}