@extends('layouts.main')

@section('container-content')
<div class="container" style="max-width: 600px">
    <h4>Masuk Kelas</h4>

    <form action="{{ route('kelas.join') }}" method="POST" style="max-width: 500px;">
        @csrf
        <div class="mb-3">
            <label for="kode_kelas" class="form-label">Masukkan Kode Kelas</label>
            <input type="text" name="kode_kelas" id="kode_kelas" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-info text-white fw-bold px-4">BUAT</button>
    </form>
</div>
@endsection
