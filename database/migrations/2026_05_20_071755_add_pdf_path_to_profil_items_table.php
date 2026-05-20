<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profil_items', function (Blueprint $table) {
            // Kita tambahkan kolom pdf_path dan tipenya string, sifatnya nullable (boleh kosong)
            // Kolom ini ditaruh tepat di bawah kolom gambar_path
            $table->string('pdf_path')->nullable()->after('gambar_path');
        });
    }

    public function down(): void
    {
        Schema::table('profil_items', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
};
