@extends('admin.admin-layout')
@section('content')
    <div class="my-3">
        <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary">Tambah Data Barang Masuk</a>

    </div>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Kode Masuk</th>
                <th>Jumlah masuk</th>
                <th>Nama Supplier Pemasok</th>
                <th>Kondisi</th>
                <th>Tanggal ditambahkan</th>
                <th>Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($bm as $index => $masuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $masuk->barang->nama_barang }}</td>
                    <td>{{ $masuk->harga_beli }}</td>
                    <td>{{ $masuk->kode_barang_masuk }}</td>
                    <td>{{ $masuk->stok_masuk }}</td>
                    <td>{{ $masuk->nama_supplier_pemasok }}</td>
                    <td>
                        <button class="btn btn-{{ $masuk->kondisi == 'baik' ? 'success' : 'danger' }}">{{ $masuk->kondisi }}</button>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($masuk->created_at)->isoFormat('HH:mm:ss, dddd, D MMMM Y') }}</td>
                    <td>
                        <a href="{{ route('barang-masuk.edit', $masuk->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('barang-masuk.destroy', $masuk->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data barang keluar ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $bm->links() }}
        </tbody>
    </table>
@endsection
