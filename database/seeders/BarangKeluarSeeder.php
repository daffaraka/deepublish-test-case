<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = Barang::pluck('id')->toArray();

        $tujuan_suppliers = ['CV. Toko Buku Jaya', 'UD. Tulis Menulis', 'PT. Peralatan Kantor', 'CV. Distributor Alat Tulis', 'PT. Sukses Mandiri'];
        $kondisi = ['baik', 'rusak'];

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'barang_id' => $barang[array_rand($barang)],
                'kode_barang_keluar' => 'BK' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'jumlah_keluar' => rand(5, 50),
                'nama_tujuan_supplier' => $tujuan_suppliers[array_rand($tujuan_suppliers)],
                'kondisi' => $kondisi[array_rand($kondisi)],
                'catatan_retur' => $kondisi[array_rand($kondisi)] === 'rusak' ? 'Barang dikembalikan karena rusak.' : 'Tidak ada catatan retur.',
            ];
        }

        DB::table('barang_keluars')->insert($data);
    }
}
