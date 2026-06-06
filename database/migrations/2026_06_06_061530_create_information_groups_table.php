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
        Schema::create('information_groups', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // e.g. berkala, sertamerta, setiapsaat, dikecualikan
            $table->string('num');      // e.g. 01, 02
            $table->string('title');    // e.g. Keuangan & Realisasi Anggaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_groups');
    }
};
