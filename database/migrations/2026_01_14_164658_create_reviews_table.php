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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_ulasan');
            // Relasi ke tabel users dan movies
            $table->foreignId('id_pengguna')->constrained('users', 'id_pengguna')->onDelete('cascade');
            $table->foreignId('id_film')->constrained('movies', 'id_film')->onDelete('cascade');
            $table->float('rating_numerik');
            $table->text('teks_ulasan');
            $table->datetime('tanggal_ulasan');
            $table->boolean('is_spoiler')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
