<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Barang masuk';
        $data['bm'] = BarangMasuk::with('barang')->latest()->paginate(5);
        return view('admin.barang-masuk.bm-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['judul'] = 'Tambah data barang masuk baru';
        $data['barangs'] = Barang::all();
        return view('admin.barang-masuk.bm-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'barang_id' => 'required',
            'kode_barang_masuk' => 'required',
            'stok_masuk' => 'required',
            'kondisi' => 'required',
            'harga_beli' => 'required',
        ]);


        if ($request->has('error')) {
            return redirect()->back()->withErrors($request->all());
        }

        $barang = Barang::find($request->barang_id);


        $barang->stok_sekarang = $barang->stok_sekarang + $request->stok_masuk;
        $barang->save();

        $bm = new BarangMasuk();
        $bm->barang_id = $request->barang_id;
        $bm->kode_barang_masuk = $request->kode_barang_masuk;
        $bm->stok_masuk = $request->stok_masuk;
        $bm->nama_supplier_pemasok = $request->nama_supplier_pemasok;
        $bm->kondisi = $request->kondisi;
        $bm->harga_beli = $request->harga_beli;
        $bm->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Data Berhasil ditambahkan');
    }



    public function show(BarangMasuk $bm)
    {
        return view('admin.barang-masuk.bm-show', compact('bm'));
    }


    public function edit(BarangMasuk $barang_masuk)
    {
        $data['barangs'] = Barang::all();
        $data['bm'] = $barang_masuk;

        // dd($data['bm']);
        return view('admin.barang-masuk.bm-edit', $data);
    }


    public function update(Request $request, BarangMasuk $barang_masuk)
    {
        $request->validate([
            'barang_id' => 'required',
            'kode_barang_masuk' => 'required',
            'stok_masuk' => 'required',
            'kondisi' => 'required',
        ]);
        if ($request->has('error')) {
            return redirect()->back()->withErrors($request->all());
        }
        $barang = Barang::find($request->barang_id);




        // if ($request->stok_masuk > $barang_masuk->stok_masuk) {

        // } else {
        //     // return 'kecil. stok masuk :  '.$request->stok_masuk .'- Stok Sekarang :'. $barang->stok_sekarang.'- Stok edit :'. $barang_masuk->stok_masuk;

        //     return 'kecil. stok update :  '.$barang->stok_sekarang .'-'. $request->stok_masuk;

        // }
        // Jika lebih besar

        if ($request->stok_masuk > $barang_masuk->stok_masuk) {
            // Jika stok masuk lebih besar dari stok lama
            $selisih = $request->stok_masuk - $barang_masuk->stok_masuk;
            $barang_masuk->stok_masuk = $request->stok_masuk;
            $barang->stok_sekarang += $selisih;
            $barang->save();
        } else {
            // Jika stok masuk lebih kecil dari stok lama
            $selisih = $barang_masuk->stok_masuk - $request->stok_masuk;
            $barang_masuk->stok_masuk = $request->stok_masuk;
            $barang->stok_sekarang -= $selisih;
            $barang->save();
        }




        $barang_masuk->barang_id = $request->barang_id;
        $barang_masuk->kode_barang_masuk = $request->kode_barang_masuk;
        $barang_masuk->stok_masuk = $request->stok_masuk;
        $barang_masuk->kondisi = $request->kondisi;
        $barang_masuk->nama_supplier_pemasok = $request->nama_supplier_pemasok;
        $barang_masuk->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Data Berhasil diperbarui');
    }


    public function destroy(BarangMasuk $barang_masuk)
    {
        $barang_masuk->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Data Berhasil');
    }
}
