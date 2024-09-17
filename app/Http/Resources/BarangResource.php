<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'barang' => $this->barang,
            'barang_masuk' => $this->barang_masuk,
            'barang_keluar' => $this->barang_keluar,

        ];
    }
}
