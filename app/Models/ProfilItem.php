<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilItem extends Model
{
    use HasFactory;

    protected $table = 'profil_items';

    protected $fillable = ['slug', 'judul', 'content_data', 'primary_image_path', 'secondary_image_path', 'primary_document_path', 'secondary_document_path', 'extra_document_path', 'hero_description'];

    protected $casts = [
        'content_data' => 'array',
    ];

    /**
     * Ambil data berdasarkan slug, jika tidak ada buat record kosong (tidak disimpan).
     * Berguna agar view tidak error saat data belum diisi.
     */
    public static function findBySlug(string $slug): self
    {
        return static::firstOrNew(['slug' => $slug]);
    }
}
