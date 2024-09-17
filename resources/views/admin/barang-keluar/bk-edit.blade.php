@extends('admin.admin-layout')
@section('content')
    <form action="{{ route('barang-keluar.update', $bk->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="">Nama Barang</label>
            <select type="text" name="barang_id" id="barang_id" class="form-control">
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}" {{ $bk->barang_id == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="">Stok Sekarang</label>
            <input type="number" name="stok_sekarang" id="stok_sekarang" class="form-control" value="{{$bk->barang->stok_sekarang}}" disabled>
        </div>

        <div class="mb-3">
            <label for="">Stok Minimal</label>
            <input type="number" name="stok_minimal" id="stok_minimal" class="form-control" value="{{$bk->barang->stok_minimal}}" disabled>
        </div>

        <div class="mb-3">
            <label for="">Jumlah keluar</label>
            <input type="number" name="jumlah_keluar" class="form-control" value="{{ $bk->jumlah_keluar }}">
        </div>
        <div class="mb-3">
            <label for="">Kode Barang Keluar</label>
            <input type="text" name="kode_barang_keluar" class="form-control" value="{{ $bk->kode_barang_keluar }}">
        </div>



        <div class="mb-3">
            <label for="">Nama Supplier</label>
            <input type="text" name="nama_tujuan_supplier" class="form-control" value="{{ $bk->nama_tujuan_supplier }}">

        </div>
        <div class="mb-3">
            <label for="">Kondisi</label>
            <select id="my-select" class="form-control" name="kondisi" value="{{ $bk->kondisi }}">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>

            </select>
        </div>


        <div class="mb-3">
            <label for="">Catatan Retur</label>
            <textarea name="catatan_retur" id="" cols="30" rows="3" class="form-control">{{ $bk->catatan_retur }} </textarea>
        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@push('scrirpts')
    <script>
        document.getElementById('barang_id').addEventListener('change', function() {
            var barangId = this.value;

            // Lakukan request ke route untuk mendapatkan detail barang
            fetch('/barang-detail/' + barangId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update form input berdasarkan data barang yang didapatkan
                    document.getElementById('stok_sekarang').value = data.stok_sekarang;
                    document.getElementById('stok_minimal').value = data.stok_minimal;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endpush
