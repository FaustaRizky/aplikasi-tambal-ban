@extends('layouts.app')

@section('title', 'Barang Laku')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('lakus.create') }}" class="btn btn-primary">+ Tambah Penjualan</a>
    </div>

    <div class="mb-3">
        <div class="alert alert-info">
            <strong>Total Pendapatan:</strong> Rp. {{ number_format($pendapatan, 0, ',', '.') }}
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <div class="mb-3">
    <form method="GET" action="{{ route('lakus.index') }}" class="row g-2">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" id="start_date" name="start_date" 
                   value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" id="end_date" name="end_date" 
                   value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-success me-2">Filter</button>
            <a href="{{ route('lakus.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Laku</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($lakus as $laku)
                @foreach($laku->details as $detail)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($laku->tanggal_laku)->format('d-m-Y') }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    @if($loop->first)
                    <td rowspan="{{ $laku->details->count() }}">
                        <form action="{{ route('lakus.destroy', $laku->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                            <a href="{{ route('lakus.edit', $laku->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
                @endforeach
            </tbody>


        </table>
    </div>
</div>
@endsection