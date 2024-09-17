<?php

namespace App\Models;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillabe = [
        'nama_barang',
        'stok_sekarang',
        'stok_minimal'
    ];
    protected $guarded = ['id'];



    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }

}
