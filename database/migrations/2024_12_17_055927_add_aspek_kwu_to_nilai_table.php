<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan aspek baru ke enum
        DB::statement("ALTER TABLE nilai MODIFY COLUMN aspek ENUM(
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
            'poin_DND',
            'poin_TTS',
            'analisa_individu_kesejarahan_II',
            'pre_test_kesejarahan',
            'post_test_kesejarahan',
            'pre_test_kwu', 
            'post_test_kwu'
        )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan kolom aspek ke versi sebelumnya
        DB::statement("ALTER TABLE nilai MODIFY COLUMN aspek ENUM(
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
            'poin_DND',
            'poin_TTS',
            'analisa_individu_kesejarahan_II',
            'pre_test_kesejarahan',
            'post_test_kesejarahan'
        )");
    }
};
