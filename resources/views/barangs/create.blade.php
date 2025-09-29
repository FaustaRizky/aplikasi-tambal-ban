@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container">
    <form action="{{ route('barangs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="jumlah_stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection