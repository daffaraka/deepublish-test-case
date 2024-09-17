@extends('admin.admin-layout')
@section('content')
    <form action="{{ route('barang-masuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="">Nama Barang</label>
            <select type="text" name="barang_id" id="barang_id" class="form-control">
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="">Stok Sekarang</label>
            <input type="number" name="stok_sekarang" id="stok_sekarang" class="form-control" value="0" disabled>
        </div>
        <div class="mb-3">
            <label for="">Harga beli</label>
            <input type="number" name="harga_beli" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Jumlah Masuk</label>
            <input type="number" name="stok_masuk" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Kode Barang Masuk</label>
            <input type="text" name="kode_barang_masuk" class="form-control">
        </div>



        <div class="mb-3">
            <label for="">Nama Supplier</label>
            <input type="text" name="nama_supplier_pemasok" class="form-control">

        </div>
        <div class="mb-3">
            <label for="">Kondisi</label>
            <select id="my-select" class="form-control" name="kondisi">
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>

            </select>
        </div>


        <div class="mb-3">
            <label for="">Catatan Retur</label>
            <textarea name="catatan_retur" id="" cols="30" rows="3" class="form-control"></textarea>
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
