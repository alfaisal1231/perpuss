<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_koleksi',
        'judul',
        'pengarang',
        'penerbit',
        'tahun',
        'status',
    ];

    protected $table = 'koleksi';

    public static function createCode()
    {
        $latestRecord = self::orderByRaw("CAST(SUBSTRING(kd_koleksi, 3, LENGTH(kd_koleksi) - 2) AS UNSIGNED) DESC")->first();
        $latestCodeNumber = optional($latestRecord)->kd_koleksi;
        $nextCodeNumber = $latestCodeNumber ? intval(substr($latestCodeNumber, 2)) + 1 : 1;
        return 'KL' . str_pad($nextCodeNumber, 4, '0', STR_PAD_LEFT);
    }

    public function pinjam()
    {
        return $this->hasMany(TrsPinjam::class, 'kd_koleksi', 'kd_koleksi');
    }
}
