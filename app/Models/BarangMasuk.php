<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable =
    [
        'barang_id',
        'kode_barang_masuk',
        'stok_masuk',
        'nama_supplier_pemasok',
        'kondisi',
        'harga_beli',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
