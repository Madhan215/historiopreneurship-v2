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
        Schema::table('nilai', function (Blueprint $table) {
            // Mengubah kolom enum 'aspek'
            $table->dropColumn('aspek'); // Hapus kolom enum yang lama
            
            // Menambahkan kolom enum yang baru dengan nilai yang diperbarui
            $table->enum('aspek', [
                'evaluasi',
                'analisa_individu_kesejarahan',
                'analisa_individu_kewirausahaan',
                'analisa_kelompok_kesejarahan',
                'analisa_kelompok_kewirausahaan_aktivitas1',
                'analisa_kelompok_kewirausahaan_aktivitas2',
                'analisa_kelompok_kewirausahaan_aktivitas3',
                'upload_file_pembelajaran3',
                'upload_file_aktivitas1',
                'upload_file_aktivitas2',
                'poin_DND_Kesejarahan', // nilai baru
                'poin_DND_KWU',         // nilai baru
                'analisa_individu_kesejarahan_II',
                'pre_test_kesejarahan',
                'post_test_kesejarahan',
                'pre_test_kwu',
                'post_test_kwu'
            ])->nullable(); // Tambahkan nullable jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            
            // Menambahkan kolom enum yang baru dengan nilai yang diperbarui
            $table->enum('aspek', [
                'evaluasi',
                'analisa_individu_kesejarahan',
                'analisa_individu_kewirausahaan',
                'analisa_kelompok_kesejarahan',
                'analisa_kelompok_kewirausahaan_aktivitas1',
                'analisa_kelompok_kewirausahaan_aktivitas2',
                'analisa_kelompok_kewirausahaan_aktivitas3',
                'upload_file_pembelajaran3',
                'upload_file_aktivitas1',
                'upload_file_aktivitas2',
                'poin_DND_Kesejarahan', // nilai baru
                'poin_DND_KWU',         // nilai baru
                'analisa_individu_kesejarahan_II',
                'pre_test_kesejarahan',
                'post_test_kesejarahan'
            ])->nullable(); // Tambahkan nullable jika diperlukan
        });
    }
};
