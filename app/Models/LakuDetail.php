<?php

// LakuDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LakuDetail extends Model
{
    use HasFactory;

    protected $fillable = ['laku_id', 'barang_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function laku()
    {
        return $this->belongsTo(Laku::class);
    }
}
