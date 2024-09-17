<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_barang' => 'Pulpen', 'stok_sekarang' => 100, 'stok_minimal' => 10],
            ['nama_barang' => 'Buku Tulis', 'stok_sekarang' => 50, 'stok_minimal' => 5],
            ['nama_barang' => 'Penggaris', 'stok_sekarang' => 70, 'stok_minimal' => 7],
            ['nama_barang' => 'Pensil', 'stok_sekarang' => 120, 'stok_minimal' => 12],
            ['nama_barang' => 'Penghapus', 'stok_sekarang' => 90, 'stok_minimal' => 9],
            ['nama_barang' => 'Spidol', 'stok_sekarang' => 60, 'stok_minimal' => 6],
            ['nama_barang' => 'Stapler', 'stok_sekarang' => 30, 'stok_minimal' => 3],
            ['nama_barang' => 'Kertas HVS', 'stok_sekarang' => 200, 'stok_minimal' => 20],
            ['nama_barang' => 'Gunting', 'stok_sekarang' => 40, 'stok_minimal' => 4],
            ['nama_barang' => 'Lem Kertas', 'stok_sekarang' => 80, 'stok_minimal' => 8],
        ];

        DB::table('barangs')->insert($data);
    }
}
