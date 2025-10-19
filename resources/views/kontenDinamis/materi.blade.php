@extends('layouts.main')

@section('container-content')
<div class="container py-4">
    <h2>{{ $judul }}</h2>
    <p><strong>Topik:</strong> {{ $topik }}</p>
    <hr>
    <div class="konten">
        {!! $konten !!} {{-- Pastikan ini hanya untuk trusted content --}}
    </div>

    {{-- 🔹 Tombol Navigasi --}}
    <div class="d-flex justify-content-between mt-4">
        @if($prevUrl)
            <a href="{{ $prevUrl }}" class="btn btn-outline-primary">&laquo; Sebelumnya</a>
        @else
            <div></div>
        @endif

        @if($nextUrl)
            <a href="{{ $nextUrl }}" class="btn btn-primary">Selanjutnya &raquo;</a>
        @endif
    </div>
</div>
@endsection
