<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('foto_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_kegiatan_id')->constrained('album_kegiatans')->onDelete('cascade');
            $table->string('path_foto');
            $table->string('keterangan_foto'); // Keterangan individual tiap foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kegiatans');
    }
};
