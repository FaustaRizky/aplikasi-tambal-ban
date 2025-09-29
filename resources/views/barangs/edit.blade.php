@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container">
    <form action="{{ route('barangs.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
                value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="jumlah_stok" class="form-control"
                value="{{ old('jumlah_stok', $barang->jumlah_stok) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                value="{{ old('harga', $barang->harga) }}"
                placeholder="contoh: 30000">
            <small class="text-muted">Harga saat ini: Rp {{ number_format($barang->harga, 0, ',', '.') }}</small>

        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection