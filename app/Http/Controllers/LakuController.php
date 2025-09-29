<?php

namespace App\Http\Controllers;

use App\Models\Laku;
use App\Models\Barang;
use App\Models\Saldo;
use Illuminate\Http\Request;

class LakuController extends Controller
{
    public function index(Request $request)
{
    $query = Laku::with(['details.barang']);

    // ✅ Filter tanggal
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal_laku', [$request->start_date, $request->end_date]);
    } elseif ($request->filled('start_date')) {
        $query->whereDate('tanggal_laku', '>=', $request->start_date);
    } elseif ($request->filled('end_date')) {
        $query->whereDate('tanggal_laku', '<=', $request->end_date);
    }

    $lakus = $query->latest()->get();

    // ✅ Hitung pendapatan dari hasil filter
    $pendapatan = 0;
    foreach ($lakus as $laku) {
        foreach ($laku->details as $detail) {
            $pendapatan += $detail->jumlah * ($detail->barang->harga ?? 0);
        }
    }

    $saldo = Saldo::first()->saldo ?? 0;

    return view('lakus.index', compact('lakus', 'pendapatan', 'saldo'));
}


    public function create()
    {
        $barangs = Barang::all();
        $saldo = Saldo::first()->saldo ?? 0;
        return view('lakus.create', compact('barangs', 'saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'jumlah' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah.*' => 'integer|min:1',
        ]);

        $laku = Laku::create([
            'tanggal_laku' => $request->tanggal,
        ]);

        $totalPendapatan = 0;

        foreach ($request->barang_id as $index => $barangId) {
            $jumlah = $request->jumlah[$index];

            $barang = Barang::find($barangId);

            $laku->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $jumlah,
            ]);

            // kurangi stok
            $barang->jumlah_stok -= $jumlah;
            $barang->save();

            // tambah pendapatan
            $totalPendapatan += $jumlah * ($barang->harga ?? 0);
        }

        // 🔥 update saldo
        $saldo = Saldo::first();
        if ($saldo) {
            $saldo->saldo += $totalPendapatan;
            $saldo->save();
        }

        return redirect()->route('lakus.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laku = Laku::with('barang')->findOrFail($id);
        $barangs = Barang::all();
        $saldo = Saldo::first()->saldo ?? 0;
        return view('lakus.edit', compact('laku', 'barangs', 'saldo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        $laku = Laku::findOrFail($id);

        // Hapus detail lama, lalu simpan ulang
        $laku->tanggal_laku = $request->tanggal;
        $laku->save();

        // Kalau pakai tabel relasi detail_lakus
        $laku->details()->delete();
        foreach ($request->barang_id as $index => $barangId) {
            $laku->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $request->jumlah[$index],
            ]);
        }

        return redirect()->route('lakus.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Laku $laku)
    {
        $laku->delete();
        return redirect()->route('lakus.index')->with('success', 'Data berhasil dihapus');
    }
}
