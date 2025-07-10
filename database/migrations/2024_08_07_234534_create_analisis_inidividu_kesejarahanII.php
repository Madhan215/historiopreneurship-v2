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
        Schema::create('analisis_individu_kesejarahanII', function (Blueprint $table) {
            $table->id('id_tabel_jawaban_individu');
            $table->integer('no_objek');
            $table->text('jawaban');
            $table->date('created_at');
            $table->string('created_by'); // nama pengguna yang membuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_individu_kesejarahanII');
    }
};
