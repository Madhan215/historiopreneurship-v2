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

    <form action="{{ route('atur-urutan.update', ['token_kelas' => $token_kelas]) }}" method="POST">
        @csrf
        <input type="hidden" name="token_kelas" value="{{ $token_kelas }}">
        @foreach ($topiks as $topik)
            <div class="mb-4 p-3 border rounded">
                <h5 class="fw-bold">Topik: {{ $topik->nama_topik }}</h5>
                <input type="number" name="topik_urutan[{{ $topik->id_topik }}]" class="form-control w-25 mb-3"
                    value="{{ $topik->urutan }}" placeholder="Urutan Topik">

                {{-- Materi --}}
                @foreach ($topik->materi as $materi)
                    <div class="ms-3">
                        <label>📚 Materi: {{ $materi->nama_materi }}</label>
                        <input type="number" name="materi_urutan[{{ $materi->id_materi }}]" class="form-control w-25 mb-2"
                            value="{{ $materi->urutan }}">
                    </div>
                @endforeach

                {{-- Evaluasi --}}
                @foreach ($topik->evaluasi as $evaluasi)
                    <div class="ms-3">
                        <label>📝 Evaluasi: {{ $evaluasi->nama_evaluasi }}</label>
                        <input type="number" name="evaluasi_urutan[{{ $evaluasi->id_evaluasi }}]" class="form-control w-25 mb-2"
                            value="{{ $evaluasi->urutan }}">
                    </div>
                @endforeach

                {{-- Upload --}}
                @foreach ($topik->upload as $upload)
                    <div class="ms-3">
                        <label>📁 Upload: {{ $upload->nama_upload }}</label>
                        <input type="number" name="upload_urutan[{{ $upload->id_upload }}]" class="form-control w-25 mb-2"
                            value="{{ $upload->urutan }}">
                    </div>
                @endforeach
            </div>
        @endforeach

        <button class="btn btn-primary">💾 Simpan Urutan</button>
    </form>

@endsection