<?php

namespace Database\Seeders;

use App\Models\Saldo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaldoSeeder extends Seeder
{
    public function run(): void
    {
        // Kalau belum ada saldo, buat saldo awal
        if (Saldo::count() == 0) {
            Saldo::create([
                'saldo' => 1000000 // contoh saldo awal Rp 1.000.000
            ]);
        }
    }
}
