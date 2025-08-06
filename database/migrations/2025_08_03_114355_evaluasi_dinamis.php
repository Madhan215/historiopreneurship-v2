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
        Schema::create('evaluasidinamis', function (Blueprint $table) {
            $table->id('id_evaluasi');
            $table->unsignedBigInteger('id_topik');
            $table->string('nama_evaluasi');
            $table->json('konten')->nullable();
            $table->enum('status', ['on', 'off'])->default('off');
            $table->unsignedInteger('urutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
