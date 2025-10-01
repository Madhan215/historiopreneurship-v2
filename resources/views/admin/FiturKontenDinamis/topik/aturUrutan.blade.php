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
        @php
            $defaultTopik = ['Pembukaan', 'Kesejarahan', 'Kewirausahaan'];
        @endphp

        @foreach ($topiks as $topik)
            <div class="mb-4 p-3 border rounded {{ in_array($topik->nama_topik, $defaultTopik) ? 'bg-light' : '' }}">
                <h5 class="fw-bold">Topik: {{ $topik->nama_topik }}</h5>

                @if(in_array($topik->nama_topik, $defaultTopik))
                    <p class="text-muted"><em>Topik default, urutan tidak bisa diubah.</em></p>
                @else
                    <input type="number" name="topik_urutan[{{ $topik->id_topik }}]" class="form-control w-25 mb-3"
                        value="{{ $topik->urutan }}" placeholder="Urutan Topik" min="1">
                @endif

                {{-- Materi --}}
                @foreach ($topik->materi as $materi)
                    <div class="ms-3 mb-2">
                        <label>📚 Materi: {{ $materi->nama_materi }}</label>
                        <input type="number" name="materi_urutan[{{ $materi->id_materi }}]" class="form-control w-25"
                            value="{{ $materi->urutan }}" min="1" {{ in_array($topik->nama_topik, $defaultTopik) ? 'disabled' : '' }}>
                    </div>
                @endforeach

                {{-- Evaluasi --}}
                @foreach ($topik->evaluasi as $evaluasi)
                    <div class="ms-3 mb-2">
                        <label>📝 Evaluasi: {{ $evaluasi->nama_evaluasi }}</label>
                        <input type="number" name="evaluasi_urutan[{{ $evaluasi->id_evaluasi }}]" class="form-control w-25"
                            value="{{ $evaluasi->urutan }}" min="1" {{ in_array($topik->nama_topik, $defaultTopik) ? 'disabled' : '' }}>
                    </div>
                @endforeach

                {{-- Upload --}}
                @foreach ($topik->upload as $upload)
                    <div class="ms-3 mb-2">
                        <label>📁 Upload: {{ $upload->nama_upload }}</label>
                        <input type="number" name="upload_urutan[{{ $upload->id_upload }}]" class="form-control w-25"
                            value="{{ $upload->urutan }}" min="1" {{ in_array($topik->nama_topik, $defaultTopik) ? 'disabled' : '' }}>
                    </div>
                @endforeach
            </div>
        @endforeach


        <button class="btn btn-primary">💾 Simpan Urutan</button>
    </form>

@endsection