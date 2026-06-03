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
        Schema::create('album_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_album');
            $table->text('deskripsi_album')->nullable(); // Sesuai request: opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_kegiatans');
    }
};
