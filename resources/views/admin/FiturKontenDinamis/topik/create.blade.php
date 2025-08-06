@extends('layouts.main')

@section('container-content')
    <h2>Tambah Topik</h2>

    <form action="{{ route('topik.store') }}" method="POST">
        @csrf

        <input type="hidden" name="token_kelas" value="{{ $token_kelas }}">

        <div class="mb-3">
            <label for="nama_topik" class="form-label">Nama Topik</label>
            <input type="text" class="form-control" name="nama_topik" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" required>
                <option value="on">Aktif</option>
                <option value="off">Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

@endsection