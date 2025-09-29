<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kulaan;
use App\Models\Saldo;

class KulaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kulaan::with('details.barang');

        // ✅ Filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_kulaan', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('tanggal_kulaan', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('tanggal_kulaan', '<=', $request->end_date);
        }

        $kulaans = $query->latest()->get();
        $saldo = Saldo::first()->saldo ?? 0;

        return view('kulaans.index', compact('kulaans', 'saldo'));
    }


    public function create()
    {
        $barangs = Barang::all();
        $saldo = Saldo::first()->saldo ?? 0;
        return view('kulaans.create', compact('barangs', 'saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'jumlah' => 'required|array',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $kulaan = Kulaan::create([
            'tanggal_kulaan' => $request->tanggal,
            'total_harga'    => $request->total_harga,
        ]);

        foreach ($request->barang_id as $index => $barangId) {
            $jumlah = $request->jumlah[$index];

            $kulaan->details()->create([
                'barang_id' => $barangId,
                'jumlah'    => $jumlah,
            ]);

            $barang = Barang::find($barangId);
            if ($barang) {
                $barang->jumlah_stok += $jumlah;
                $barang->save();
            }
        }

        // 🔥 kurangi saldo sesuai kulaan
        $saldo = Saldo::first();
        if ($saldo) {
            $saldo->saldo -= $request->total_harga;
            $saldo->save();
        }

        return redirect()->route('kulaans.index')->with('success', 'Data kulaan berhasil ditambahkan, stok barang diperbarui!');
    }

    public function show($id)
    {
        $kulaan = Kulaan::with('details.barang')->findOrFail($id);
        $saldo = Saldo::first()->saldo ?? 0;

        return view('kulaans.show', compact('kulaan', 'saldo'));
    }
}
