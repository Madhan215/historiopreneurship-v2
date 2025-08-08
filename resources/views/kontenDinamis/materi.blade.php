@extends('layouts.main')

@section('container-content')
<div class="container py-4">
    <h2>{{ $judul }}</h2>
    <p><strong>Topik:</strong> {{ $topik }}</p>
    <hr>
    <div class="konten">
        {!! $konten !!} {{-- Pastikan ini hanya untuk trusted content --}}
    </div>
</div>
@endsection