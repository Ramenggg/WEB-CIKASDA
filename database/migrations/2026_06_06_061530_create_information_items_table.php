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
        Schema::create('information_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('information_group_id')->constrained('information_groups')->onDelete('cascade');
            $table->string('title');
            $table->text('detail');
            $table->string('link')->nullable();
            $table->string('type'); // internal, external, dikecualikan
            $table->string('status')->nullable();
            $table->string('dasar_hukum')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_items');
    }
};
