@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Topik</h2>

    @foreach($topiks as $topik)
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                {{ ucfirst($topik->nama_topik) }}
            </div>
            <div class="card-body">

                @foreach($topik->subtopiks_urut as $item)
                    @php
                        $icon = $item['tipe'] == 'materi' ? '📘' :
                                ($item['tipe'] == 'evaluasi' ? '📝' : '📤');

                        $url = url("/{$topik->nama_topik}/{$item['nama']}");
                        $label = ucfirst($item['tipe']);
                    @endphp

                    <p>
                        {{ $icon }} <a href="{{ $url }}">{{ $item['nama'] }}</a> ({{ $label }})
                    </p>
                @endforeach

            </div>
        </div>
    @endforeach
</div>
@endsection
