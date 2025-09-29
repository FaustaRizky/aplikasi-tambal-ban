@extends('layouts.app')

@section('title', 'Edit Barang Laku')

@section('content')
<div class="container">

    <form action="{{ route('lakus.update', $laku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $laku->tanggal_laku }}" required>
        </div>

        <div id="barang-wrapper">
           @foreach($laku->details as $detail)
<div class="row mb-3 barang-item">
    <div class="col-md-6 mb-2">
        <label class="form-label">Barang</label>
        <select name="barang_id[]" class="form-control" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}" {{ $detail->barang_id == $barang->id ? 'selected' : '' }}>
                    {{ $barang->nama_barang }} (Stok: {{ $barang->jumlah_stok }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-2">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah[]" class="form-control" value="{{ $detail->jumlah }}" min="1" required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button type="button" class="btn btn-danger remove-barang">Hapus</button>
    </div>
</div>
@endforeach

        </div>

        <div class="mb-3">
            <button type="button" id="add-barang" class="btn btn-info">+ Tambah Barang</button>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('lakus.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script untuk tambah/hapus field barang --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const wrapper = document.getElementById("barang-wrapper");
    const addBtn = document.getElementById("add-barang");

    addBtn.addEventListener("click", function() {
        let newItem = wrapper.querySelector(".barang-item").cloneNode(true);
        newItem.querySelector("select").value = "";
        newItem.querySelector("input").value = "";
        wrapper.appendChild(newItem);
    });

    wrapper.addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-barang")) {
            if (wrapper.querySelectorAll(".barang-item").length > 1) {
                e.target.closest(".barang-item").remove();
            } else {
                alert("Minimal 1 barang harus diisi.");
            }
        }
    });
});
</script>
@endpush
@endsection
