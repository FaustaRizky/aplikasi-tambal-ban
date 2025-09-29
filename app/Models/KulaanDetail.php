<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KulaanDetail extends Model
{
    protected $fillable = ['kulaan_id', 'barang_id', 'jumlah', 'harga_satuan', 'subtotal'];

    public function kulaan()
    {
        return $this->belongsTo(Kulaan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
