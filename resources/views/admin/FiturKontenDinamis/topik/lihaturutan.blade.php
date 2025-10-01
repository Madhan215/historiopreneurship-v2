@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">Urutan Topik & Subtopik</h2>

    @foreach($topiks as $topik)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                {{ $topik->urutan }}. {{ $topik->nama_topik }}
            </div>
            <div class="card-body">
                {{-- Kalau ada default isi untuk topik ini --}}
                @if(isset($defaultIsi[$topik->nama_topik]))
                    <h6 class="text-secondary fw-bold">📑 Struktur {{ $topik->nama_topik }}</h6>
                    <ol class="list-group list-group-numbered mb-3">
                        @foreach ($defaultIsi[$topik->nama_topik] as $item)
                            <li class="list-group-item">{{ $item }}</li>
                        @endforeach
                    </ol>
                @endif

                {{-- Subtopik dari DB --}}
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

    <a href="{{ route('topik.index', ['token_kelas' => request('token_kelas')]) }}" 
       class="btn btn-primary mb-3">⬅ Kembali</a>
@endsection
