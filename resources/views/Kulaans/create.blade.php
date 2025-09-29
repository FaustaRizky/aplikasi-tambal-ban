@extends('layouts.app')

@section('title', 'Tambah Kulaan')

@section('content')
<div class="container">
    <form action="{{ route('kulaans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tanggal Kulaan</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="kulaan-items">
        <tr>
            <td>
                <select name="barang_id[]" class="form-control select-barang" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
            </td>
        </tr>
    </tbody>
</table>

        <button type="button" class="btn btn-sm btn-secondary" onclick="addRow()">+ Tambah Barang</button>

        <div class="mt-3">
            <label>Total Harga Kulaan</label>
            <input type="number" step="0.01" name="total_harga" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
function addRow() {
    let row = `
    <tr>
        <td>
            <select name="barang_id[]" class="form-control select-barang" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="jumlah[]" class="form-control" required>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
        </td>
    </tr>
    `;
    document.getElementById('kulaan-items').insertAdjacentHTML('beforeend', row);
    $('.select-barang').select2(); // aktifkan select2 setiap kali row ditambah
}

function removeRow(button) {
    let row = button.closest('tr');
    row.remove();
}


$(document).ready(function() {
    $('.select-barang').select2(); // aktifkan select2 pertama kali
});
</script>

@endsection
