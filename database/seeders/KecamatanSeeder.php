<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $currentTime = now();

        $kecamatan = [
            [
                'id' => 1,
                'nama_kecamatan' => 'Sumbersari',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 2,
                'nama_kecamatan' => 'Ajung',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 3,
                'nama_kecamatan' => 'Ambulu',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 4,
                'nama_kecamatan' => 'Tanggul',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 5,
                'nama_kecamatan' => 'Tempurejo',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 6,
                'nama_kecamatan' => 'Umbulsari',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 7,
                'nama_kecamatan' => 'Wuluhan',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 8,
                'nama_kecamatan' => 'Patrang',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 9,
                'nama_kecamatan' => 'Arjasa',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 10,
                'nama_kecamatan' => 'Bangsalsari',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 11,
                'nama_kecamatan' => 'Balung',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 12,
                'nama_kecamatan' => 'Gumukmas',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 13,
                'nama_kecamatan' => 'Jelbuk',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 14,
                'nama_kecamatan' => 'Jenggawah',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 15,
                'nama_kecamatan' => 'Jombang',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 16,
                'nama_kecamatan' => 'Kalisat',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 17,
                'nama_kecamatan' => 'Kencong',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 18,
                'nama_kecamatan' => 'Ledokombo',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 19,
                'nama_kecamatan' => 'Mayang',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 20,
                'nama_kecamatan' => 'Mumbulsari',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 21,
                'nama_kecamatan' => 'Panti',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 22,
                'nama_kecamatan' => 'Pakusari',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 23,
                'nama_kecamatan' => 'Puger',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 24,
                'nama_kecamatan' => 'Rambipuji',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 25,
                'nama_kecamatan' => 'Semboro',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 26,
                'nama_kecamatan' => 'Silo',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 27,
                'nama_kecamatan' => 'Sukorambi',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 28,
                'nama_kecamatan' => 'Sukowono',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 29,
                'nama_kecamatan' => 'Sumberbaru',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ],
            [
                'id' => 30,
                'nama_kecamatan' => 'Sumberjambe',
                'created_at' => $currentTime,
                'updated_at' => $currentTime
            ]
        ];

        DB::table('kecamatan')->insert($kecamatan);
    }
}
