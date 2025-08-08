@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2>{{ $judul ?? 'Kegiatan Pembelajaran' }}</h2>

<!-- === Konten Upload dari Database === -->
@if (!empty($konten))
    <div class="konten mt-4">
        <form method="POST" action="{{ route('uploadFileDinamis') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="{{ $judul ?? 'kegiatan pembelajaran' }}">
            {!! $konten !!} {{-- Menampilkan tag input upload dari database --}}
            
            <div class="d-flex justify-content-start mt-3">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
@endif

<!-- === Preview File dan Penilaian === -->
@if (!empty($uploadedFile))
    <div class="mt-5">
        <h5>File yang Sudah Diunggah:</h5>

        <!-- Tombol untuk membuka modal -->
        <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pdfModal">
                <i class="bi bi-eye me-1"></i> Lihat File
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed src="{{ asset('storage/' . $uploadedFile->file_path) }}" type="application/pdf" width="100%" height="600px" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Penilaian -->
        <div class="card-body mt-4 border-top pt-4">
            <label for="nilaiIndividu" class="mb-2 fw-semibold">Nilai diperoleh</label>
            <div class="input-group mb-3">
                <span class="input-group-text">Nilai</span>
                <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                    value="{{ $nilaiUploadKegiatanPembelajaran3->nilai_akhir ?? '' }}"
                    {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>
            </div>

            <label for="feedbackIndividu" class="fw-semibold">Feedback dari dosen</label>
            <textarea class="form-control mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5"
                {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>{{ $nilaiUploadKegiatanPembelajaran3->data_jawaban_penilai ?? '' }}</textarea>
        </div>
    </div>
@endif

@endsection
