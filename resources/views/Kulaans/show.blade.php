@extends('layouts.app')

@section('title', 'Detail Kulaan')

@section('content')
<div class="container">
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kulaan->tanggal_kulaan)->format('d-m-Y') }}</p>
    <p><strong>Total Pengeluaran:</strong> Rp. {{ number_format($kulaan->total_harga, 0, ',', '.') }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kulaan->details as $index => $detail)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $detail->barang->nama_barang }}</td>
                <td>{{ $detail->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('kulaans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
