@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">Urutan Topik & Subtopik</h2>

    @foreach($topiks as $topik)
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{ $topik->urutan }}. {{ $topik->nama_topik }}</strong>
            </div>
            <div class="card-body">
                @if($topik->subtopiks_urut->count())
                    <ol>
                        @foreach($topik->subtopiks_urut as $item)
                            <li>{{ $item['nama'] }} <em>({{ $item['tipe'] }})</em></li>
                        @endforeach
                    </ol>
                @else
                    <p><em>Tidak ada subtopik.</em></p>
                @endif
            </div>
        </div>
    @endforeach

    <a href="{{ route('topik.index', ['token_kelas' => request('token_kelas')]) }}" class="btn btn-primary mb-3">Kembali</a>

@endsection