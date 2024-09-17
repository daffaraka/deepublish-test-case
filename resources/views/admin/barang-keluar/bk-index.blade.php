@extends('admin.admin-layout')
@section('content')
    <div class="my-3">
        <a href="{{ route('barang-keluar.create') }}" class="btn btn-primary">Tambah Data Barang Keluar</a>

    </div>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Jumlah keluar</th>
                <th>Nama Tujuan Supplier</th>
                <th>Kondisi</th>
                <th>Catatan Retur</th>
                <th>Tanggal ditambahkan</th>
                <th>Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($bk as $index => $keluar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $keluar->barang->nama_barang }}</td>
                    <td>{{ $keluar->kode_barang_keluar }}</td>
                    <td>{{ $keluar->jumlah_keluar }}</td>
                    <td>{{ $keluar->nama_tujuan_supplier }}</td>
                    <td>
                        <button class="btn btn-{{ $keluar->kondisi == 'baik' ? 'success' : 'danger' }}">{{ $keluar->kondisi }}</button>
                    </td>
                    <td>{{ $keluar->catatan_retur }}</td>
                    <td>{{ \Carbon\Carbon::parse($keluar->created_at)->isoFormat('HH:mm:ss, dddd, D MMMM Y') }}</td>
                    <td>
                        <a href="{{ route('barang-keluar.show', $keluar->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('barang-keluar.edit', $keluar->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('barang-keluar.destroy', $keluar->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data barang keluar ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            {{ $bk->links() }}
        </tbody>
    </table>
@endsection
