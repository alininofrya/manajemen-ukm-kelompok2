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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            // Siapa yang mendaftar
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // ID Event (nullable karena bisa saja dia daftar UKM, bukan event)
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');

            // ID UKM (nullable karena bisa saja dia daftar Event, bukan jadi anggota UKM)
            $table->foreignId('ukm_id')->nullable()->constrained('ukms')->onDelete('cascade');

            // Kolom berkas (buat nullable jika pendaftaran event tidak selalu butuh berkas)
            $table->string('berkas')->nullable();

            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};