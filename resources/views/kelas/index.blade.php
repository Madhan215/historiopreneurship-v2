@extends('layouts.main')

@section('container-content')
<div class="container">
    <h2>Kelas Saya <a href="{{ route('kelas.create') }}" class="btn btn-primary float-end">TAMBAH</a></h2>
    @foreach($kelas as $k)
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">{{ $k->nama_kelas }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $k->kode_kelas }}</h6>
            <p class="card-text">{{ $k->deskripsi_kelas }}</p>
            <small>Dibuat pada: {{ \Carbon\Carbon::parse($k->tanggal_dibuat)->isoFormat('dddd, D MMMM Y') }}</small>
            <div class="mt-3">
                <a href="#" class="btn btn-success">MASUK</a>
                <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-info">EDIT</a>
                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">HAPUS</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
