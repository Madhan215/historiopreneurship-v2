@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">🔀 Atur Urutan Topik & Subtopik</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h5 class="text-muted mb-3">Token Kelas: <strong>{{ $token_kelas }}</strong></h5>

    {{-- Tombol Kembali --}}
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('atur-urutan.update', ['token_kelas' => $token_kelas]) }}" method="POST">
        @csrf
        <input type="hidden" name="token_kelas" value="{{ $token_kelas }}">

        @php
            // Filter defaultTopik yang statusnya 'on'
            $default = $topiks->whereIn('nama_topik', $defaultTopik)
                ->where('status_default', 'on');
            $tambahan = $topiks->whereNotIn('nama_topik', $defaultTopik);
        @endphp

        {{-- Topik Default --}}
        @if($default->count())
            <h4 class="mb-3">📌 Topik Default</h4>
            @foreach ($default as $topik)
                <div class="card mb-4 border-light shadow-sm">
                    <div class="card-body bg-light">
                        <h5 class="fw-bold">Topik: {{ $topik->nama_topik }}</h5>
                        <p class="text-muted"><em>Topik default, urutan tidak bisa diubah.</em></p>

                        @if(isset($defaultIsi[$topik->nama_topik]))
                            @foreach($defaultIsi[$topik->nama_topik] as $item)
                                <div class="ms-3 mb-2">
                                    <i class="bi bi-dot"></i> {{ $item }}
                                </div>
                            @endforeach
                        @endif

                        @foreach ($topik->materi as $materi)
                            <div class="ms-3 mb-2"><i class="bi bi-book"></i> 📚 {{ $materi->nama_materi }}</div>
                        @endforeach
                        @foreach ($topik->evaluasi as $evaluasi)
                            <div class="ms-3 mb-2"><i class="bi bi-pencil-square"></i> 📝 {{ $evaluasi->nama_evaluasi }}</div>
                        @endforeach
                        @foreach ($topik->upload as $upload)
                            <div class="ms-3 mb-2"><i class="bi bi-file-earmark"></i> 📁 {{ $upload->nama_upload }}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif


        {{-- Topik Tambahan --}}
        @if($tambahan->count())
            <h4 class="mb-3">✨ Topik Tambahan</h4>
            @foreach ($tambahan as $topik)
                <div class="card mb-4 border-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Topik: {{ $topik->nama_topik }}</h5>
                        <input type="number" name="topik_urutan[{{ $topik->id_topik }}]" class="form-control w-25 mb-3"
                            value="{{ $topik->urutan }}" placeholder="Urutan Topik" min="1">

                        {{-- Materi --}}
                        @foreach ($topik->materi as $materi)
                            <div class="ms-3 mb-2">
                                <label>📚 {{ $materi->nama_materi }}</label>
                                <input type="number" name="materi_urutan[{{ $materi->id_materi }}]" class="form-control w-25"
                                    value="{{ $materi->urutan }}" min="1">
                            </div>
                        @endforeach

                        {{-- Evaluasi --}}
                        @foreach ($topik->evaluasi as $evaluasi)
                            <div class="ms-3 mb-2">
                                <label>📝 {{ $evaluasi->nama_evaluasi }}</label>
                                <input type="number" name="evaluasi_urutan[{{ $evaluasi->id_evaluasi }}]" class="form-control w-25"
                                    value="{{ $evaluasi->urutan }}" min="1">
                            </div>
                        @endforeach

                        {{-- Upload --}}
                        @foreach ($topik->upload as $upload)
                            <div class="ms-3 mb-2">
                                <label>📁 {{ $upload->nama_upload }}</label>
                                <input type="number" name="upload_urutan[{{ $upload->id_upload }}]" class="form-control w-25"
                                    value="{{ $upload->urutan }}" min="1">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

        <button class="btn btn-primary">💾 Simpan Urutan</button>
    </form>
@endsection