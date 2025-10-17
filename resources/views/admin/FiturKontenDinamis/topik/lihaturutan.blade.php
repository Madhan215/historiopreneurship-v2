@extends('layouts.main')

@section('container-content')
<h2 class="mb-4 fw-bold">Urutan Topik & Subtopik</h2>
<a href="{{ route('topik.index', ['token_kelas' => request('token_kelas')]) }}" 
   class="btn btn-secondary mb-3">Kembali</a>

@php
    $defaultTopik = ['Pembukaan', 'Kesejarahan', 'Kewirausahaan'];
    $default = $topiks->whereIn('nama_topik', $defaultTopik);
    $tambahan = $topiks->whereNotIn('nama_topik', $defaultTopik);
@endphp

{{-- Topik Default --}}
@if($default->count())
    <h4 class="mb-3">📌 Topik Default</h4>
    @foreach ($default as $topik)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light fw-bold">
                {{ $topik->urutan }}. {{ $topik->nama_topik }} <span class="text-muted">(Default)</span>
            </div>
            <div class="card-body">
                {{-- Default Isi --}}
                @if(isset($defaultIsi[$topik->nama_topik]))
                    <h6 class="text-secondary fw-bold">📑 Struktur {{ $topik->nama_topik }}</h6>
                    <ol class="list-group list-group-numbered mb-3">
                        @foreach ($defaultIsi[$topik->nama_topik] as $item)
                            <li class="list-group-item">{{ $item }}</li>
                        @endforeach
                    </ol>
                @endif

                {{-- Subtopik tambahan (jika ada) --}}
                @if($topik->subtopiks_urut->count())
                    <h6 class="text-secondary fw-bold">📂 Subtopik Tambahan</h6>
                    <ol class="list-group list-group-numbered">
                        @foreach($topik->subtopiks_urut as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item['nama'] }}
                                <span class="badge bg-info">{{ $item['tipe'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    @endforeach
@endif

{{-- Topik Tambahan --}}
@if($tambahan->count())
    <h4 class="mb-3">✨ Topik Tambahan</h4>
    @foreach ($tambahan as $topik)
        <div class="card mb-4 shadow-sm border-primary">
            <div class="card-header bg-primary text-white fw-bold">
                {{ $topik->urutan }}. {{ $topik->nama_topik }}
            </div>
            <div class="card-body">
                {{-- Subtopik tambahan --}}
                @if($topik->subtopiks_urut->count())
                    <ol class="list-group list-group-numbered">
                        @foreach($topik->subtopiks_urut as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item['nama'] }}
                                <span class="badge bg-info">{{ $item['tipe'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-muted"><em>Tidak ada subtopik tambahan.</em></p>
                @endif
            </div>
        </div>
    @endforeach
@endif


@endsection
