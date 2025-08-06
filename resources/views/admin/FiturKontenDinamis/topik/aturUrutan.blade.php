@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">🔀 Atur Urutan Topik & Subtopik</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h5 class="text-muted mb-3">Token Kelas: <strong>{{ $token_kelas }}</strong></h5>

    <form action="{{ route('atur-urutan.update', ['token_kelas' => $token_kelas]) }}" method="POST">
        @csrf
        <input type="hidden" name="token_kelas" value="{{ $token_kelas }}">
        @foreach ($topiks as $topik)
            <div class="mb-4 p-3 border rounded">
                <h5 class="fw-bold">Topik: {{ $topik->nama_topik }}</h5>
                <input type="hidden" name="topik_id[]" value="{{ $topik->id_topik }}">
                <input type="number" name="topik_urutan[]" class="form-control w-25 mb-3" value="{{ $topik->urutan }}"
                    placeholder="Urutan Topik">

                {{-- Materi --}}
                @foreach ($topik->materi as $materi)
                    <div class="ms-3">
                        <label>📚 Materi: {{ $materi->nama_materi }}</label>
                        <input type="hidden" name="materi_id[]" value="{{ $materi->id_materi }}">
                        <input type="number" name="materi_urutan[]" class="form-control w-25 mb-2" value="{{ $materi->urutan }}">
                    </div>
                @endforeach

                {{-- Evaluasi --}}
                @foreach ($topik->evaluasi as $evaluasi)
                    <div class="ms-3">
                        <label>📝 Evaluasi: {{ $evaluasi->nama_evaluasi }}</label>
                        <input type="hidden" name="evaluasi_id[]" value="{{ $evaluasi->id_evaluasi }}">
                        <input type="number" name="evaluasi_urutan[]" class="form-control w-25 mb-2"
                            value="{{ $evaluasi->urutan }}">
                    </div>
                @endforeach

                {{-- Upload --}}
                @foreach ($topik->upload as $upload)
                    <div class="ms-3">
                        <label>📁 Upload: {{ $upload->nama_upload }}</label>
                        <input type="hidden" name="upload_id[]" value="{{ $upload->id_upload }}">
                        <input type="number" name="upload_urutan[]" class="form-control w-25 mb-2" value="{{ $upload->urutan }}">
                    </div>
                @endforeach
            </div>
        @endforeach

        <button class="btn btn-primary">💾 Simpan Urutan</button>
    </form>
@endsection