<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kulaan extends Model
{
    protected $fillable = ['tanggal_kulaan', 'total_harga'];

    public function details()
    {
        return $this->hasMany(KulaanDetail::class);
    }
}
