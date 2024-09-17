<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['judul'] = 'Data Barang';
        $data['barangs'] = Barang::all();
        return view('admin.barang.barang-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['judul'] = 'Tambah barang baru';
        return view('admin.barang.barang-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok_sekarang' => 'required',
            'stok_minimal' => 'required',
        ]);

        $barangs = new Barang();
        $barangs->nama_barang = $request->nama_barang;
        $barangs->stok_sekarang = $request->stok_sekarang;
        $barangs->stok_minimal = $request->stok_minimal;
        $barangs->save();
        return redirect()->route('barang.index')->with('success', 'Data Berhasil');
    }


    public function show(Barang $barang)
    {
        return view('admin.barang.barang-show', compact('barangs'));
    }


    public function edit(Barang $barang)
    {
        return view('admin.barang.barang-edit', compact('barang'));
    }


    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok_sekarang' => 'required',
            'stok_minimal' => 'required',
        ]);

        $barang->nama_barang = $request->nama_barang;
        $barang->stok_sekarang = $request->stok_sekarang;
        $barang->stok_minimal = $request->stok_minimal;
        $barang->save();
        return redirect()->route('barang.index')->with('success', 'Data Berhasil');
    }


    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data Berhasil');
    }
}
