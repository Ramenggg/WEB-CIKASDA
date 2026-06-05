<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VideoDokumentasi extends Model
{
    protected $table = 'video_dokumentasis';
    protected $fillable = ['judul_video', 'deskripsi_video', 'url_youtube', 'file_video'];
    protected $appends = ['url_video'];

    public function getUrlVideoAttribute(): ?string
    {
        if (!$this->file_video) {
            return null;
        }

        if (filter_var($this->file_video, FILTER_VALIDATE_URL)) {
            return $this->file_video;
        }

        $disk = config('filesystems.default') === 'supabase' ? 'supabase' : 'public';

        return Storage::disk($disk)->url($this->file_video);
    }
}
