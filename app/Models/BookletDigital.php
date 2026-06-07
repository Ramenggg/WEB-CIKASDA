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
        return $this->getFileUrl($this->file_pdf);
    }

    public function getUrlSampulAttribute(): ?string
    {
        return $this->getFileUrl($this->path_sampul);
    }

    private function getFileUrl(?string $path): ?string
    {
        if (!$path) return null;
        if (filter_var($path, FILTER_VALIDATE_URL)) return $path;

        $disk = config('filesystems.default') === 'supabase' ? 'supabase' : 'public';
        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk($disk);
        return $storage->url($path);
    }
}
