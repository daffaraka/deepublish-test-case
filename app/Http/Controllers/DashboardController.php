<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['jumlah_barang'] = Barang::count();
        $data['barang_masuk'] = BarangMasuk::count();
        $data['barang_keluar'] = BarangKeluar::count();
        return view('admin.admin-dashboard', $data);
    }
}
