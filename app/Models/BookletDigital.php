<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookletDigital extends Model
{
    use HasFactory;

    protected $table = 'booklet_digitals';

    protected $fillable = ['judul_booklet', 'deskripsi_booklet', 'file_pdf', 'url_external'];
}
