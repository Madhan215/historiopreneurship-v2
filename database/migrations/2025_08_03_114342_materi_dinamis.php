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
        Schema::create('materidinamis', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_topik');
            $table->string('nama_materi');
            $table->longText('konten')->nullable();
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
