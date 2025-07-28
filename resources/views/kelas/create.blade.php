@extends('layouts.main')

@section('container-content')
<div class="container mt-5" style="max-width: 600px">
    <h2>Tambah Kelas</h2>

    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Kelas</label>
            <textarea name="deskripsi_kelas" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">BUAT</button>
    </form>
</div>
@endsection