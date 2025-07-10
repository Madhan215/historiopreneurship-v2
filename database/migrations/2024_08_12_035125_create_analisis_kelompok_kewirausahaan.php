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
        Schema::create('analisis_kelompok_kewirausahaan', function (Blueprint $table) {
            $table->id('id_tabel_kelompok');
            $table->integer('id_kelompok');
            $table->enum('kategori', ['aktivitas 1', 'aktivitas 2', 'aktivitas 3']);
            $table->enum('aspek', ['Pengalaman yang didapat','kelebihan e-commerce','kekurangan e-commerce','Jenis-jenis teknologi','Pengaruh Teknologi','Kelebihan dan Kekurangan penggunaan teknologi','kondisi proses sebelum dan sesudah','Hasil analisa kelompok']);
            $table->text('jawaban')->nullable();
            $table->date('created_at');
            $table->string('created_by'); // nama pengguna yang membuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_kelompok_kewirausahaan');
    }
};
