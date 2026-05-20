<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['judul', 'file_path', 'tipe']; // tipe: foto/video
}
