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
        Schema::create('soal_dadakan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_soal')->index();
            $table->json('data_jawaban_penilai');
            $table->integer('nilai_akhir');
            $table->date('batas_waktu');
            $table->enum('status',['aktif','tidak_aktif']);
            $table->date('created_at');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_dadakan');
    }
};
