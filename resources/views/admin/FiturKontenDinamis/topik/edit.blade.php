@extends('layouts.main')

@section('container-content')
    <h2>Tambah Topik</h2>

    <form action="{{ route('topik.update', $topik) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Topik</label>
            <input type="text" name="nama_topik" class="form-control" required value="{{ $topik->nama_topik }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" required>
                <option value="on">Aktif</option>
                <option value="off">Nonaktif</option>
            </select>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
@endsection