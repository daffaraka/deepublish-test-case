<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $barang = Barang::pluck('id')->toArray();

        $suppliers = ['PT. Pena Maju', 'CV. Buku Sejahtera', 'UD. Alat Tulis', 'PT. Grafit Jaya', 'CV. Karet Bersih', 'PT. Warna Abadi', 'CV. Staple Indonesia', 'PT. Kertas Jaya', 'UD. Alat Perkantoran', 'PT. Perekat Indonesia'];
        $kondisi = ['baik', 'rusak'];

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'barang_id' => $barang[array_rand($barang)],
                'kode_barang_masuk' => 'BM' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'stok_masuk' => rand(10, 100),
                'nama_supplier_pemasok' => $suppliers[array_rand($suppliers)],
                'kondisi' => $kondisi[array_rand($kondisi)],
                'harga_beli' => rand(1000, 50000),
            ];
        }

        DB::table('barang_masuks')->insert($data);
    }
}
