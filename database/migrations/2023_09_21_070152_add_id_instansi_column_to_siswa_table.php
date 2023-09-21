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
        Schema::table('siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_instansi')->after('email');
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
            $table->dropForeign(['id_instansi']);
            $table->dropColumn('id_instansi');
        });
    }
};
