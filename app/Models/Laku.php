<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laku extends Model
{
    use HasFactory;

    // Tambahkan ini
    protected $fillable = ['tanggal_laku'];

    // Relasi ke detail
    // Laku.php
    public function details()
{
    return $this->hasMany(LakuDetail::class);
}


    // Relasi ke barang (jika ingin shortcut)
    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'laku_details')->withPivot('jumlah');
    }
}
