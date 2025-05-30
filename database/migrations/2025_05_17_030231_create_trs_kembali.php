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
        Schema::create('trs_kembali', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi_kembali');
            $table->string('kd_anggota');
            $table->date('tg_pinjam');
            $table->date('tg_bts_kembali');
            $table->date('tg_kembali');
            $table->string('kd_koleksi');
            $table->integer('denda');
            $table->text('ket');
            $table->integer('id_pengguna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_kembali');
    }
};
