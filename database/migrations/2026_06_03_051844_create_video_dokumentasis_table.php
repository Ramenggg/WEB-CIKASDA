<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_video');
            $table->text('deskripsi_video')->nullable();
            $table->string('url_youtube')->nullable(); // pastikan sudah nullable
            $table->string('file_video')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_dokumentasis');
    }
};
