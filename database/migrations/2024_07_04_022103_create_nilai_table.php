<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_tabel_nilai');
            $table->string('email')->index();
            $table->unsignedBigInteger('id_soal')->index()->nullable();
            $table->enum(
                'aspek',
                [
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
                    'poin_DND_Kesejarahan',
                    'poin_TTS_KWU',
                    'analisa_individu_kesejarahan_II',
                    'pre_test_kesejarahan',
                    'post_test_kesejarahan'
                ]
            );
            $table->string('data_jawaban_penilai')->nullable();
            $table->integer('nilai_akhir')->nullable();
            $table->integer('percobaan_ke')->nullable();
            $table->integer('lama_waktu_pengerjaan')->nullable();
            $table->date('waktu_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
