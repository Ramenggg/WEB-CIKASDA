<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booklet_digitals', function (Blueprint $table) {
            $table->id();
            $table->string('judul_booklet');
            $table->text('deskripsi_booklet')->nullable();
            $table->string('file_pdf')->nullable(); // Menyimpan path file .pdf lokal
            $table->string('url_external')->nullable(); // Menyimpan tautan link alternatif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booklet_digitals');
    }
};
