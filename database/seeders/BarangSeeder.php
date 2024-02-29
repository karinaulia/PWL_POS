<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'KNZLR_SSH',
                'barang_nama' => 'Kanzler Sosis Singles Hot',
                'harga_beli' => 5200,
                'harga_jual' => 8800,
                'created_at' => now(),
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 2,
                'barang_kode' => 'CTT_SP',
                'barang_nama' => 'Chitato Sapi Panggang 120gr',
                'harga_beli' => 20000,
                'harga_jual' => 25800,
                'created_at' => now(),
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 3,
                'barang_kode' => 'HYCC',
                'barang_nama' => 'Hydro Coco 330ml',
                'harga_beli' => 5000,
                'harga_jual' => 8100,
                'created_at' => now(),
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 4,
                'barang_kode' => 'WHKS_TN',
                'barang_nama' => 'WHISKAS Makanan Kucing Kering 480gr - Tuna',
                'harga_beli' => 32200,
                'harga_jual' => 38400,
                'created_at' => now(),
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 5,
                'barang_kode' => 'BTR_ALK_A2',
                'barang_nama' => 'Baterai ABC Alkaline AA 4+2',
                'harga_beli' => 20800,
                'harga_jual' => 25200,
                'created_at' => now(),
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 1,
                'barang_kode' => 'FST_CHNGT',
                'barang_nama' => 'Fiesta Chicken Nugget 500gr',
                'harga_beli' => 39600,
                'harga_jual' => 49900,
                'created_at' => now(),
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'CTT_LT',
                'barang_nama' => 'Chitato Lite Rumput Laut 120gr',
                'harga_beli' => 32700,
                'harga_jual' => 38100,
                'created_at' => now(),
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 3,
                'barang_kode' => 'ULTM_FC',
                'barang_nama' => 'Ultra Milk Full Cream Susu UHT 1 Liter',
                'harga_beli' => 14200,
                'harga_jual' => 19400,
                'created_at' => now(),
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 4,
                'barang_kode' => 'RYL_CNN',
                'barang_nama' => 'Royal Canin Mini Puppy Makanan Anak Anjing 2kg',
                'harga_beli' => 221900,
                'harga_jual' => 249200,
                'created_at' => now(),
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'KNM_STK',
                'barang_nama' => 'Kenmaster Stop Kontak 4 Lubang F1-4 Overheat',
                'harga_beli' => 64400,
                'harga_jual' => 79900,
                'created_at' => now(),
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
