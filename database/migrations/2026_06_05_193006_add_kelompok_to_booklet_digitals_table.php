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
        Schema::table('booklet_digitals', function (Blueprint $table) {
            $table->string('kelompok')->default('Sungai Pantai Danau dan Air Baku')->after('judul_booklet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booklet_digitals', function (Blueprint $table) {
            $table->dropColumn('kelompok');
        });
    }
};
