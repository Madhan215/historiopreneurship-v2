@extends('layouts.main')

@section('container-content')
    <h2>Manajemen Konten</h2>

    <form method="GET" class="mb-3">
        <label>Pilih Kategori:</label>
        <select name="kategori_konten" onchange="this.form.submit()" class="form-select w-auto d-inline">
            @foreach ($kategoriList as $kat)
                <option value="{{ $kat }}" {{ $kat == $kategoriDipilih ? 'selected' : '' }}>
                    {{ $kat }}
                </option>
            @endforeach
        </select>
    </form>

    <a href="{{ route('manajemen-konten.create', ['kategori' => $kategoriDipilih]) }}" class="btn btn-primary mb-3">Tambah
        Konten</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Urut</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->nomor }}</td>
                    <td>{!! $item->konten !!}</td>
                    <td>
                        <a href="{{ route('manajemen-konten.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('manajemen-konten.destroy', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus konten ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada konten.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection