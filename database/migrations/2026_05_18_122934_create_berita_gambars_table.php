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
        Schema::create('berita_gambars', function (Blueprint $table) {
            $table->id();
            // Menghubungkan gambar ke ID beritanya. Jika berita dihapus, gambarnya ikut terhapus otomatis (cascade)
            $table->foreignId('berita_id')->constrained('beritas')->onDelete('cascade');
            $table->string('file_path'); // Tempat menyimpan lokasi file di storage
            $table->integer('urutan')->default(0); // MENYIMPAN URUTAN DRAG-AND-DROP KAMU!
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_gambars');
    }
};
