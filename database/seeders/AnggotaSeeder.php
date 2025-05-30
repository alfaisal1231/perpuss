<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anggota')->insert([
            [
                'kd_anggota' => 'AN0001',
                'nm_anggota' => 'NABILA AZZAHRA',
                'jk' => 'P',
                'alamat' => 'BANJAR',
                'status' => 'AKTIF',
                'jml_pinjam' => '2',
            ],
            [
                'kd_anggota' => 'AN0002',
                'nm_anggota' => 'ASEP MANARUL HIDAYAH',
                'jk' => 'L',
                'alamat' => 'TASIKMALAYA',
                'status' => 'AKTIF',
                'jml_pinjam' => '5',
            ]
        ]);
    }
}
