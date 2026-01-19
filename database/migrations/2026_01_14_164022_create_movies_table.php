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
        Schema::create('movies', function (Blueprint $table) {
            $table->id('id_film');
            $table->string('judul');
            $table->integer('tahun_rilis');
            $table->text('sinopsis');
            $table->string('sutradara');
            $table->integer('durasi_menit');
            $table->string('poster_url');

            // --- TAMBAHAN FITUR BARU ---
            // Menggunakan string untuk link YouTube/Trailer
            $table->string('trailer_url')->nullable();

            // Karena tidak ada tabel bioskop, kita pakai text untuk list bioskop
            // Contoh isi: "XXI Jakarta, CGV Seoul, IMAX London"
            $table->text('lokasi_bioskop')->nullable();

            $table->float('rating_rata_rata')->default(0);
            // ---------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
