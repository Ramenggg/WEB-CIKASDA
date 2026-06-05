<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoKegiatan extends Model
{
    protected $fillable = ['album_kegiatan_id', 'path_foto', 'keterangan_foto'];
    protected $appends = ['url_foto'];

    public function album()
    {
        return $this->belongsTo(AlbumKegiatan::class, 'album_kegiatan_id');
    }

    public function getUrlFotoAttribute(): ?string
    {
        if (!$this->path_foto) {
            return null;
        }

        if (filter_var($this->path_foto, FILTER_VALIDATE_URL)) {
            return $this->path_foto;
        }

        $disk = config('filesystems.default') === 'supabase' ? 'supabase' : 'public';

        return Storage::disk($disk)->url($this->path_foto);
    }
}
