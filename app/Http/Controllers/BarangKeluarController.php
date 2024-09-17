<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Barang Keluar';
        $data['bk'] = BarangKeluar::with('barang')->latest()->paginate(5);
        return view('admin.barang-keluar.bk-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['judul'] = 'Tambah data barang keluar baru';
        $data['barangs'] = Barang::all();
        return view('admin.barang-keluar.bk-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'kode_barang_keluar' => 'required',
            'jumlah_keluar' => 'required',
            'kondisi' => 'required',
        ]);
        if ($request->has('error')) {
            return redirect()->back()->withErrors($request->all());
        }

        $barang = Barang::find($request->barang_id);

        if ($barang->stok_sekarang < $request->jumlah_keluar) {
            return redirect()->route('barang-keluar.create')->with('error', 'Stok tidak mencukupi');
        } else {
            $barang->stok_sekarang = $barang->stok_sekarang - $request->jumlah_keluar;
            $barang->save();

            $bk = new BarangKeluar();
            $bk->barang_id = $request->barang_id;
            $bk->kode_barang_keluar = $request->kode_barang_keluar;
            $bk->jumlah_keluar = $request->jumlah_keluar;
            $bk->nama_tujuan_supplier = $request->nama_tujuan_supplier;
            $bk->kondisi = $request->kondisi;
            $bk->catatan_retur = $request->catatan_retur;
            $bk->save();

            return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil ditambahkan');

        }


    }


    public function show(BarangKeluar $bk)
    {
        return view('admin.barang-keluar.bk-show', compact('bk'));
    }


    public function edit(BarangKeluar $barang_keluar)
    {
        $data['barangs'] = Barang::all();
        $data['bk'] = $barang_keluar;

        // dd($data['bk']);
        return view('admin.barang-keluar.bk-edit', $data);
    }


    public function update(Request $request, BarangKeluar $barang_keluar)
    {
        $request->validate([
            'barang_id' => 'required',
            'kode_barang_keluar' => 'required',
            'jumlah_keluar' => 'required',
            'kondisi' => 'required',
        ]);
        if ($request->has('error')) {
            return redirect()->back()->withErrors($request->all());
        }
        $barang = Barang::find($request->barang_id);

        if ($barang->stok_sekarang < $request->jumlah_keluar) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        } else {
            $barang->stok_sekarang = $barang->stok_sekarang - $request->jumlah_keluar;
            $barang->save();

            $barang_keluar->barang_id = $request->barang_id;
            $barang_keluar->kode_barang_keluar = $request->kode_barang_keluar;
            $barang_keluar->jumlah_keluar = $request->jumlah_keluar;
            $barang_keluar->nama_tujuan_supplier = $request->nama_tujuan_supplier;
            $barang_keluar->kondisi = $request->kondisi;
            $barang_keluar->catatan_retur = $request->catatan_retur;
            $barang_keluar->save();

            return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil diperbarui');

        }
    }


    public function destroy(BarangKeluar $bk)
    {
        $bk->delete();
        return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil');
    }
}
