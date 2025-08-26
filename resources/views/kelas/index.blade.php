@extends('layouts.main')

@section('container-content')
<div class="container">
    <h2>
        Kelas Saya
        @if(auth()->user()->peran === 'guru')
            <a href="{{ route('kelas.create') }}" class="btn btn-primary float-end">TAMBAH</a>
            <a href="{{ route('kelas.input.form') }}" class="btn btn-primary float-left">MASUKKAN KODE</a>
        @endif
        @if(auth()->user()->peran === 'siswa')
            <a href="{{ route('kelas.input.form') }}" class="btn btn-primary float-end">MASUKKAN KODE</a>
        @endif
    </h2>

    @foreach($kelas as $k)
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">{{ $k->nama_kelas }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $k->kode_kelas }}</h6>
            <p class="card-text">{{ $k->deskripsi_kelas }}</p>
            <small>Dibuat pada: {{ \Carbon\Carbon::parse($k->tanggal_dibuat)->isoFormat('dddd, D MMMM Y') }}</small>
            <div class="mt-3">
            @php
                $tokens = auth()->user()->token_kelas ?? [];
                $status = collect($tokens)->firstWhere('kode', $k->kode_kelas)['status'] ?? 'tidak aktif';
            @endphp
            <form action="{{ route('kelas.updateUser', $k->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" 
                    class="btn {{ $status === 'aktif' ? 'btn-danger' : 'btn-success' }}">
                    {{ $status === 'aktif' ? 'KELUAR' : 'MASUK' }}
                </button>
            </form>

                @if(auth()->user()->peran === 'guru')
                    <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-info">EDIT</a>
                    <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">HAPUS</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
