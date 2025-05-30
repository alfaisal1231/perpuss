<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_anggota',
        'nm_anggota',
        'jk',
        'alamat',
        'status',
        'jml_pinjam',
    ];

    protected $table = 'anggota';

    public static function createCode()
    {
        $latestRecord = self::orderByRaw("CAST(SUBSTRING(kd_anggota, 3, LENGTH(kd_anggota) - 2) AS UNSIGNED) DESC")->first();
        $latestCodeNumber = optional($latestRecord)->kd_anggota;
        $nextCodeNumber = $latestCodeNumber ? intval(substr($latestCodeNumber, 2)) + 1 : 1;
        return 'AN' . str_pad($nextCodeNumber, 4, '0', STR_PAD_LEFT);
    }

    public function pinjam()
    {
        return $this->hasMany(TrsPinjam::class, 'kd_anggota');
    }
}
