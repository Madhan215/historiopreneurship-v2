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
        Schema::create('refleksidinamis', function (Blueprint $table) {
            $table->id('id_refleksi');
            $table->unsignedBigInteger('id_topik'); // bisa jadi id topik refleksi atau kategori refleksi
            $table->string('nama_refleksi');
            $table->longText('konten')->nullable(); 
            $table->enum('status', ['on', 'off'])->default('off'); // misal: aktif/tidak
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
