<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoKegiatan extends Model
{
    protected $fillable = ['album_kegiatan_id', 'path_foto', 'keterangan_foto'];

    public function album()
    {
        return $this->belongsTo(AlbumKegiatan::class, 'album_kegiatan_id');
    }
}
