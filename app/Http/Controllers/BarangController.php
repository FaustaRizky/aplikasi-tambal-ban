<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Saldo;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang
     */
    public function index(Request $request)
{
    $query = Barang::query();

    // 🔍 Filter pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nama_barang', 'like', "%{$search}%")
              ->orWhere('jumlah_stok', 'like', "%{$search}%");
    }

    // 🔽🔼 Sorting stok
    if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
        $query->orderBy('jumlah_stok', $request->sort);
    }

    $barangs = $query->get();
     $saldo = Saldo::first()->saldo ?? 0;

    return view('barangs.index', compact('barangs', 'saldo'));
}

    /**
     * Tampilkan form tambah barang
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Simpan barang baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barangs.index')
                         ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit barang
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update barang di database
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barangs.index')
                         ->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Hapus barang
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barangs.index')
                         ->with('success', 'Barang berhasil dihapus!');
    }
}
