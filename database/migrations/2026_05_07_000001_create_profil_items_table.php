<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_items', function (Blueprint $table) {
            $table->id();
            // Kunci unik untuk mengidentifikasi jenis konten, contoh: 'struktur', 'visi-misi', 'tugas-fungsi'
            $table->string('slug')->unique();
            // Judul konten
            $table->string('judul')->nullable();
            // Isi narasi / teks penjelasan
            $table->longText('konten')->nullable();
            // Path gambar/bagan yang diupload (disimpan di storage/app/public/)
            $table->string('gambar_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_items');
    }
};
