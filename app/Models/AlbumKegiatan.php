<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumKegiatan extends Model
{
    protected $fillable = ['judul_album', 'kategori', 'deskripsi_album'];

    public function fotos()
    {
        return $this->hasMany(FotoKegiatan::class, 'album_kegiatan_id');
    }
}
