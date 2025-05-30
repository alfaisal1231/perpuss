<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trskembali extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_transaksi_kembali',
        'kd_anggota',
        'tg_pinjam',
        'tg_bts_kembali',
        'tg_kembali',
        'kd_koleksi',
        'denda',
        'ket',
        'id_pengguna',
    ];

    protected $table = 'trs_kembali';

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'kd_anggota', 'kd_anggota');
    }

    public function koleksi()
    {
        return $this->belongsTo(Koleksi::class, 'kd_koleksi', 'kd_koleksi');
    }
}
