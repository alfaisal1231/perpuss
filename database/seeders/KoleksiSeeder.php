<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KoleksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('koleksi')->insert([
            [
                'kd_koleksi' => 'KL0001',
                'judul' => 'PADANG BULAN',
                'pengarang' => 'ANDREA HIRATA',
                'penerbit' => 'GRAMEDIA',
                'tahun' => '2024',
                'status' => 'TERSEDIA',
            ],
            [
                'kd_koleksi' => 'KL0002',
                'judul' => 'HUJAN',
                'pengarang' => 'TERE LIYE',
                'penerbit' => 'GRAMEDIA',
                'tahun' => '2023',
                'status' => 'TERSEDIA',
            ]
        ]);
    }
}
