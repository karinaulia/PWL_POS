<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Nurul',
                'penjualan_kode' => 'TR001',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => 'Mega',
                'penjualan_kode' => 'TR002',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => 'Nur',
                'penjualan_kode' => 'TR003',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => 'Cahaya',
                'penjualan_kode' => 'TR004',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Wibi',
                'penjualan_kode' => 'TR005',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 2,
                'pembeli' => 'Sri',
                'penjualan_kode' => 'TR006',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Dian',
                'penjualan_kode' => 'TR007',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Eka',
                'penjualan_kode' => 'TR008',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Kusuma',
                'penjualan_kode' => 'TR009',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Tri',
                'penjualan_kode' => 'TR0010',
                'penjualan_tanggal' => '2024-02-29 15:56:00',
                'created_at' => now(),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
