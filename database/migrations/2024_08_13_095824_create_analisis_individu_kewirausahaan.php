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
        Schema::create('analisis_individu_kewirausahaan', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->enum('aspek', ['produk atau jasa yang akan dirancang', 'Analisa produk atau jasa yang digunakan','langkah kerja' ,'pendapat tentang hasil proyek yang telah dibuat', 'Hal yang bisa dilakukan agar proyek menjadi lebih baik atau lebih sempurna']);
            $table->text('jawaban');
            $table->date('created_at');
            $table->string('created_by'); // Email user yang menjawab
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_individu_kewirausahaan');
    }
};
