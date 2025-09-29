@extends('layouts.app')

@section('title', 'Tambah Barang Laku')

@section('content')
<div class="container">

    <form action="{{ route('lakus.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div id="barang-wrapper">
            <div class="row mb-3 barang-item border p-2 rounded bg-light">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Barang</label>
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">
                                {{ $barang->nama_barang }} (Stok: {{ $barang->jumlah_stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control" min="1" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-barang">Hapus</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" id="add-barang" class="btn btn-info">+ Tambah Barang</button>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
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

@section('scripts')
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
@endsection

