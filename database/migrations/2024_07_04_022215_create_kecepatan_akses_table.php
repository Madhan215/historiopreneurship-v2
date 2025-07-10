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
        Schema::create('kecepatan_akses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->enum('jenis_materi',['materi1','materi2','materi3']);
            $table->date('waktu_akses_awal');
            $table->date('waktu_pengelesaian_kuis');
            $table->date('created_at');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecepatan_akses');
    }
};
