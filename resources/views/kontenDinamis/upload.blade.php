@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2>{{ $judul ?? 'Kegiatan Pembelajaran' }}</h2>

@if (!empty($konten))
    <div class="konten mt-4">
        <form method="POST" action="{{ route('uploadFileDinamis') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="{{ $judul ?? 'kegiatan pembelajaran' }}">
            {!! $konten !!}

            @if(!empty($maxSizes))
                <p class="text-muted mt-2">
                    Maksimal ukuran file:
                    @foreach($maxSizes as $type => $size)
                        {{ strtoupper($type) }} = {{ $size }} KB
                        @if(!$loop->last), @endif
                    @endforeach
                </p>
            @endif

            <div class="d-flex justify-content-start mt-3">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
@endif

@if (!empty($uploadedFile))
    <div class="mt-5">
        <h5>File yang Sudah Diunggah:</h5>

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#fileModal">
            <i class="bi bi-eye me-1"></i> Lihat File
        </button>

        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileModalLabel">Pratinjau File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        @php
                            $filePath = asset('storage/' . $uploadedFile->file_path);
                            $extension = strtolower(pathinfo($uploadedFile->file_path, PATHINFO_EXTENSION));
                        @endphp

                        @if (in_array($extension, ['pdf']))
                            <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="600px" />
                        @else
                            <p>Silakan unduh untuk melihat isinya.</p>
                            <a href="{{ $filePath }}" class="btn btn-primary" download>Unduh File</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- 🔹 Navigasi Prev/Next --}}
<div class="d-flex justify-content-between mt-4">
    @if($prevUrl)
        <a href="{{ $prevUrl }}" class="btn btn-outline-primary">&laquo; Sebelumnya</a>
    @else
        <div></div>
    @endif

    @if($nextUrl)
        <a href="{{ $nextUrl }}" class="btn btn-primary">Selanjutnya &raquo;</a>
    @endif
</div>

@endsection
