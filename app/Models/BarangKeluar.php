<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable =
    [
        'barang_id',
        'kode_barang_keluar',
        'jumlah_keluar',
        'nama_tujuan_supplier',
        'kondisi',
        'catatan_retur',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
