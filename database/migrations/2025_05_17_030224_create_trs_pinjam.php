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
        Schema::create('trs_pinjam', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi_pinjam');
            $table->string('kd_anggota');
            $table->date('tg_pinjam');
            $table->date('tgl_bts_kembali');
            $table->string('kd_koleksi');
            $table->integer('id_pengguna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_pinjam');
    }
};
