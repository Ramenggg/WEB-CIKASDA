<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaGambar extends Model
{
    protected $fillable = ['berita_id', 'file_path', 'urutan'];

    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class);
    }
}