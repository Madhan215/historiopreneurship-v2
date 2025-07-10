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
        Schema::create('analisis_individu_kesejarahan', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->enum('aspek', ['wisata', 'kesejarahan', 'urgensi objek kesejarahan', 'urgensi kesejarahan']);
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
        Schema::dropIfExists('analisis_individu_kesejarahan');
    }
};
