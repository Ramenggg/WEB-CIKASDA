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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique(); // Untuk URL ramah SEO (misal: cikasda.com/berita/judul-berita)
            $table->text('konten');
            $table->string('kategori'); // Infrastruktur, Pengumuman, dll
            $table->string('status')->default('Publish'); // Publish atau Draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
