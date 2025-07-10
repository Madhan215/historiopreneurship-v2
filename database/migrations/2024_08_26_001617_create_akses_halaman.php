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
        Schema::create('akses_halaman', function (Blueprint $table) {
            $table->id();
            $table->foreign('email')->references('email')->on('users');
            $table->string('email')->index();
            $table->string('materi_a')->nullable();
            $table->string('materi_b')->nullable();
            $table->string('materi_c')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_halaman');
    }
};
