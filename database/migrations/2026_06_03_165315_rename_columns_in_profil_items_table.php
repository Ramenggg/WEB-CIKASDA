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
        Schema::table('profil_items', function (Blueprint $table) {
            $table->renameColumn('gambar_path', 'primary_image_path');
            $table->renameColumn('gambar_path_2', 'secondary_image_path');
            $table->renameColumn('pdf_path', 'primary_document_path');
            $table->renameColumn('pdf_path_2', 'secondary_document_path');
            $table->renameColumn('konten', 'content_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_items', function (Blueprint $table) {
            $table->renameColumn('primary_image_path', 'gambar_path');
            $table->renameColumn('secondary_image_path', 'gambar_path_2');
            $table->renameColumn('primary_document_path', 'pdf_path');
            $table->renameColumn('secondary_document_path', 'pdf_path_2');
            $table->renameColumn('content_data', 'konten');
        });
    }
};
