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
        Schema::table('user_badge', function (Blueprint $table) {
            $table->foreign('id_badge')->references('id')->on('badge');
            $table->foreign('email')->references('email')->on('users');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
            $table->foreign('id_soal')->references('id')->on('soals');
        });

        Schema::table('user_kelas', function (Blueprint $table) {
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('email')->references('email')->on('users');
        });

        Schema::table('kecepatan_akses', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
        });

        Schema::table('soal_dadakan', function (Blueprint $table) {
            $table->foreign('id_soal')->references('id')->on('soals');
        });
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('created_by')->references('email')->on('users');
        });
        Schema::table('kelompok', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
    
};