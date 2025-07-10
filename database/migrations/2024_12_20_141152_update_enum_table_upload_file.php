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
        Schema::table('upload_file_tugas', function (Blueprint $table) {
            // Mengubah kolom enum 'aspek'
            $table->dropColumn('kategori'); // Hapus kolom enum yang lama
            
            // Menambahkan kolom enum yang baru dengan nilai yang diperbarui
            $table->enum('kategori', ['kegiatan pembelajaran 3','proyek individu', 'praktik lapangan 1', 'praktik lapangan 2']);//kategori
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload_file_tugas', function (Blueprint $table) {
            // Mengubah kolom enum 'aspek'
            $table->dropColumn('kategori'); // Hapus kolom enum yang lama
            
            // Menambahkan kolom enum yang baru dengan nilai yang diperbarui
            $table->enum('kategori', ['kegiatan pembelajaran 3', 'praktik lapangan 1', 'praktik lapangan 2']);//kategori
        });
    }
};
