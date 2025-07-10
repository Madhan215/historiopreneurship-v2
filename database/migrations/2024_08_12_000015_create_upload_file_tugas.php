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
        Schema::create('upload_file_tugas', function (Blueprint $table) {
            $table->id('id_upload_tabel'); // Auto-incrementing primary key
            $table->enum('kategori', ['kegiatan pembelajaran 3', 'praktik lapangan 1', 'praktik lapangan 2']);//kategori
            $table->string('file_path'); // Path to the file
            $table->string('original_name'); // Original name of the file
            $table->string('mime_type'); // MIME type of the file
            $table->integer('size'); // Size of the file in bytes
            $table->string('created_by'); // User who uploaded the file 
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_file_tugas');
    }
};
