<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('manajemen_konten', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_konten', [
                'kegiatanPembelajaran1',
                'kegiatanPembelajaran2',
                'kegiatanPembelajaran3',
                'preTestKesejarahan',
                'postTestKesejarahan',
                'kuisKesejarahan',
                'refleksi',
                'preTestKewirausahaan',
                'postTestKewirausahaan',
                'analisisIndividu',
                'analisisKelompok1',
                'analisisKelompok2',
                'diskusiKelompok',
                'kuisKwuDanKepariwisataan',
                'kwuDanKepariwisataan',
                'praktikLapangan1',
                'praktikLapangan2',
                'proyekIndividu',
                'refleksi2'
            ]);
            $table->integer('nomor'); // urutan
            $table->longText('konten'); // HTML konten
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_konten');
    }
};
