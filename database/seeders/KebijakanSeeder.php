<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KebijakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kebijakan')->insert([
            [
                'max_wkt_pjm' => '2',
                'max_jml_koleksi' => '2',
                'denda' => '500'
            ]
        ]);
    }
}
