@extends('admin.admin-layout')
@section('content')
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Stok Sekarang</label>
            <input type="number" name="stok_sekarang" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Stok Minimal</label>
            <input type="number" name="stok_minimal" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
