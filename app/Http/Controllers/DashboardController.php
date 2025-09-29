<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $query = Barang::query();

    // Search filter
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nama_barang', 'like', "%{$search}%")
              ->orWhere('jumlah_stok', 'like', "%{$search}%");
    }

    // Sort stok
    if ($request->sort == 'asc') {
        $query->orderBy('jumlah_stok', 'asc');
    } elseif ($request->sort == 'desc') {
        $query->orderBy('jumlah_stok', 'desc');
    }

    $barangs = $query->get();

    // Widget Saldo
    $saldo = \App\Models\Saldo::first()->saldo ?? 0;

    // Widget Jumlah Barang
    $totalBarang = Barang::count();

    // 🔥 Ambil hanya transaksi hari ini & kemarin
    $startDate = Carbon::yesterday()->startOfDay(); // kemarin jam 00:00
    $endDate   = Carbon::now()->endOfDay();         // hari ini jam 23:59

    $lakus = \App\Models\Laku::with('details.barang')
        ->whereBetween('tanggal_laku', [$startDate, $endDate])
        ->get();

    // Hitung pendapatan
    $pendapatan = $lakus->flatMap->details->sum(function ($detail) {
        return $detail->jumlah * ($detail->barang->harga ?? 0);
    });

    // Kumpulkan detail penjualan untuk modal
    $soldDetails = $lakus->flatMap->details->map(function ($detail) {
        return (object)[
            'tanggal' => $detail->laku->tanggal_laku ?? null,
            'nama_barang' => $detail->barang->nama_barang ?? '-',
            'jumlah' => $detail->jumlah,
            'harga' => $detail->barang->harga ?? 0,
            'subtotal' => $detail->jumlah * ($detail->barang->harga ?? 0),
        ];
    });

    // Widget Total Kulaan (ambil dari total_harga kulaan terbaru)
$totalKulaan = \App\Models\Kulaan::latest('tanggal_kulaan')
    ->first()
    ->total_harga ?? 0;


    return view('dashboard.index', compact(
        'barangs',
        'saldo',
        'totalBarang',
        'pendapatan',
        'totalKulaan',
        'soldDetails'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
