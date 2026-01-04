<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {

            $table->id();
            $table->string('nim',10)->nullable()->unique();
            $table->string('first_name', 100);
            $table->string('last_name',100);
            $table->date('birthday')->nullable();
            $table->string('gender');
            $table->enum('prodi',['TI','SI','TRK','TET','Akuntansi','TM','TL','TRM','TE','TRJT']);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
