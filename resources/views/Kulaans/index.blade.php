@extends('layouts.app')

@section('title', 'Data Kulaan')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('kulaans.create') }}" class="btn btn-primary">+ Tambah Kulaan</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="mb-3">
    <form method="GET" action="{{ route('kulaans.index') }}" class="row g-2">
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
            <a href="{{ route('kulaans.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Pengeluaran</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kulaans as $index => $kulaan)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ \Carbon\Carbon::parse($kulaan->tanggal_kulaan)->format('d-m-Y') }}</td>
                <td>Rp. {{ number_format($kulaan->total_harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('kulaans.show', $kulaan->id) }}" class="btn btn-info btn-sm">
                        Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection