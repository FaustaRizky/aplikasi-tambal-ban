@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- 🔹 Row Widget di luar tabel -->
    <div class="row">
        <!-- Widget Saldo -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Saldo
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($saldo, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widget Barang -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Barang
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalBarang ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widget Laku -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2"
                style="cursor: pointer;"
                data-bs-toggle="modal" data-bs-target="#lakuModal">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Laku
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($pendapatan, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widget Kulaan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Kulaan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp. {{ number_format($totalKulaan, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-basket fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Tabel Barang -->
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <h3 class="card-title mb-2 mb-md-0">📊 Stok Barang</h3>

            <div class="card-tools d-flex flex-wrap gap-2">
                <!-- 🔍 Search -->
                <form action="{{ route('dashboard.index') }}" method="GET" class="d-flex w-100 w-md-auto">
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
                    <a href="{{ route('dashboard.index', array_merge(request()->all(), ['sort' => 'desc'])) }}"
                        class="btn btn-sm btn-outline-success">
                        <i class="fas fa-sort-amount-up"></i>
                    </a>
                    <a href="{{ route('dashboard.index', array_merge(request()->all(), ['sort' => 'asc'])) }}"
                        class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-sort-amount-down"></i>
                    </a>
                </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td class="text-center">{{ $barang->jumlah_stok }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
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
<!-- Modal Detail Laku -->
<div class="modal fade" id="lakuModal" tabindex="-1" aria-labelledby="lakuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lakuModalLabel">📋 Detail Penjualan (Laku)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if(!empty($soldDetails) && count($soldDetails))
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th style="width:100px" class="text-end">Jumlah</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soldDetails as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td class="text-end">{{ $row->jumlah }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-muted">Belum ada data penjualan.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection