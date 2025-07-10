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
        Schema::create('form_kelayakan', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('aspect'); // Kolom untuk aspek (misalnya: Daya Tarik, Aksesbilitas)
            $table->string('sub_aspect'); // Kolom untuk sub-aspek (misalnya: Memiliki keunikan)
            $table->integer('score')->nullable(); // Kolom untuk skor (1-5), nullable jika tidak diisi
            $table->text('reason')->nullable(); // Kolom untuk alasan, nullable jika tidak diisi
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->string('email')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kelayakan');
    }
};
