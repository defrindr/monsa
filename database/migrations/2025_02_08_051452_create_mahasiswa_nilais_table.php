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
        Schema::create('mahasiswa_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->references('id')->on('kelas');
            $table->foreignId('matkul_id')->references('id')->on('matkuls');
            $table->foreignId('mahasiswa_id')->references('id')->on('mahasiswas');
            $table->integer('nilai_tugas')->default(0);
            $table->integer('nilai_uts')->default(0);
            $table->integer('nilai_uas')->default(0);
            $table->integer('nilai_akhir')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_nilais');
    }
};
