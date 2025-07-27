@extends('layouts.home')

@section('container')
    @if (session('success'))
        <div class="alert alert-success floating-alert fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="mb-4">Ganti Nama</h2>

    <form action="{{ route('update.nama') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Baru</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', Auth::user()->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
