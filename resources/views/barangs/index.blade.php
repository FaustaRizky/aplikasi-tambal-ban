@extends('layouts.app')

@section('title', 'Daftar Stok Barang')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <h3 class="card-title mb-2 mb-md-0">📦 Stok Barang</h3>
            <div class="card-tools d-flex flex-wrap gap-2">

                <!-- 🔍 Search Form -->
                <form action="{{ route('barangs.index') }}" method="GET" class="d-flex w-100 w-md-auto">
                    <input type="text" name="search"
                        class="form-control form-control-sm"
                        placeholder="Cari nama atau stok..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary ml-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- 🔽🔼 Sort stok -->
                <div class="btn-group">
                    <a href="{{ route('barangs.index', array_merge(request()->all(), ['sort' => 'desc'])) }}"
                        class="btn btn-sm btn-outline-success">
                        <i class="fas fa-sort-amount-up"></i>
                    </a>
                    <a href="{{ route('barangs.index', array_merge(request()->all(), ['sort' => 'asc'])) }}"
                        class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-sort-amount-down"></i>
                    </a>
                </div>

                <!-- ➕ Tambah -->
                <a href="{{ route('barangs.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Barang
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Nama Barang</th>
                            <th style="width: 120px">Stok</th>
                            <th style="width: 150px">Harga</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td class="text-center">{{ $barang->jumlah_stok }}</td>
                            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus barang ini?')"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Tidak ada data barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection