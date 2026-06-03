<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilItem extends Model
{
    use HasFactory;

    protected $table = 'profil_items';

    protected $fillable = ['slug', 'judul', 'konten', 'gambar_path', 'gambar_path_2', 'pdf_path'];

    /**
     * Ambil data berdasarkan slug, jika tidak ada buat record kosong (tidak disimpan).
     * Berguna agar view tidak error saat data belum diisi.
     */
    public static function findBySlug(string $slug): self
    {
        return static::firstOrNew(['slug' => $slug]);
    }
}
