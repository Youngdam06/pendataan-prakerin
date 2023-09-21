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
            $table->unsignedBigInteger('id_pembimbing')->after('id_instansi');
            $table->foreign('id_pembimbing')->references('id')->on('pembimbing')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
            $table->dropForeign(['id_pembimbing']);
            $table->dropColumn('id_pembimbing');
        });
    }
};
