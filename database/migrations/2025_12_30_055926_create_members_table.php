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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel UKM
            $table->foreignId('ukm_id')->constrained('ukms')->onDelete('cascade');
            // Menghubungkan ke tabel Users (Mahasiswa yang jadi pengurus)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Kolom jabatan (Ketua, Sekretaris, Bendahara, dll)
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
