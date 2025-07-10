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
        Schema::create('user_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelas')->index();
            $table->string('email')->index();
            $table->enum('persetujuan', ['disetujui', 'tidak disetujui']);
            $table->date('created_at');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kelas');
    }
};
