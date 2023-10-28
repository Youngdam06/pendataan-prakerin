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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->integer('ketepatan_waktu');
            $table->integer('sikap_kerja');
            $table->integer('tanggung_jawab');
            $table->integer('kehadiran');
            $table->integer('kemampuan_kerja');
            $table->integer('keterampilan_kerja');
            $table->integer('kualitas_kerja');
            $table->integer('berkomunikasi');
            $table->integer('kerjasama');
            $table->integer('kerajinan');
            $table->integer('rasa_pd');
            $table->integer('mematuhi_aturan');
            $table->integer('penampilan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
