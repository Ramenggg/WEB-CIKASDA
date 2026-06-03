<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDokumentasi extends Model
{
    protected $table = 'video_dokumentasis';
    protected $fillable = ['judul_video', 'deskripsi_video', 'url_youtube', 'file_video'];
}
