<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Get the default disk based on environment/config.
     */
    public function getDisk(): string
    {
        return config('filesystems.default') === 'supabase' ? 'supabase' : 'public';
    }

    /**
     * Upload a file and return its relative path.
     */
    public function upload(UploadedFile $file, string $path, ?string $prefix = null): string
    {
        $disk = $this->getDisk();
        $filename = ($prefix ? $prefix . '_' : '') . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
        return $file->storeAs($path, $filename, $disk);
    }

    /**
     * Get the full URL for a given relative path.
     */
    public function url(?string $path): ?string
    {
        if (!$path) return null;
        if (filter_var($path, FILTER_VALIDATE_URL)) return $path;

        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk($this->getDisk());
        return $storage->url($path);
    }

    /**
     * Delete a file from the disk.
     */
    public function delete(?string $path): bool
    {
        if (!$path) return false;
        if (filter_var($path, FILTER_VALIDATE_URL)) return false; // Don't delete external URLs

        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk($this->getDisk());
        return $storage->delete($path);
    }
}
