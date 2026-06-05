<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BookletDigital extends Model
{
    use HasFactory;

    protected $table = 'booklet_digitals';

    protected $fillable = ['judul_booklet', 'path_sampul', 'kelompok', 'kategori', 'deskripsi_booklet', 'file_pdf', 'url_external'];
    protected $appends = ['url_booklet', 'url_sampul'];

    public function getUrlBookletAttribute(): ?string
    {
        if (!$this->file_pdf) {
            return null;
        }

        if (filter_var($this->file_pdf, FILTER_VALIDATE_URL)) {
            return $this->file_pdf;
        }

        $disk = config('filesystems.default') === 'supabase' ? 'supabase' : 'public';

        return Storage::disk($disk)->url($this->file_pdf);
    }

    public function getUrlSampulAttribute(): ?string
    {
        if (!$this->path_sampul) {
            return null;
        }

        if (filter_var($this->path_sampul, FILTER_VALIDATE_URL)) {
            return $this->path_sampul;
        }

        $disk = config('filesystems.default') === 'supabase' ? 'supabase' : 'public';

        return Storage::disk($disk)->url($this->path_sampul);
    }
}
