@extends('layouts.main')

@section('container-content')

<h2>Kegiatan Pembelajaran 1</h2>
<p class="text-sm">2 JP x @50 menit = 100 menit.</p>

@foreach ($currentContent as $paragraph)
    {!! $paragraph !!}
@endforeach

<div class="mt-3">
    <h5>Halaman:</h5>
    <div>
        @for ($i = 1; $i <= $totalPages; $i++)
            <a href="{{ route('B-2', ['page' => $i]) }}" class="btn btn-link {{ $i == $page ? 'text-white fw-bold  bg-primary' : '' }}">{{ $i }}</a>
        @endfor
    </div>
</div>

@endsection