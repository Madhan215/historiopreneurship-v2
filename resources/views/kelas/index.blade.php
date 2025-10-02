@extends('layouts.main')

@section('container-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kelas ini akan dihapus dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

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
            <h6 class="card-subtitle mb-2 text-muted">Kode kelas: {{ $k->kode_kelas }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Dibuat oleh: {{ $k->guru->nama_lengkap ?? '-' }}
                
            </h6>
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
                    <form id="delete-form-{{ $k->id }}" action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $k->id }})">HAPUS</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
