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
        Schema::table('prakerin', function (Blueprint $table) {
            $table->unsignedBigInteger('id_siswa')->after('tanggal_akhir');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prakerin', function (Blueprint $table) {
            //
            $table->dropForeign(['id_siwa']);
            $table->dropColumn('id_siswa');
        });
    }
};
