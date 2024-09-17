@extends('admin.admin-layout')
@section('content')
    <div class="my-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Stok Sekarang</th>
                <th>Stok Minimal</th>
                <th>Tanggal ditambahkan</th>
                <th>Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok_sekarang }}</td> <!-- Menampilkan 'N/A' jika stok null -->
                    <td>{{ $barang->stok_minimal }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->created_at)->isoFormat('HH:mm:ss, dddd, D MMMM Y') }}</td>
                    <td>
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
