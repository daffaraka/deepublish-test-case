<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangAPIController extends Controller
{

    public function detail($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }
}
