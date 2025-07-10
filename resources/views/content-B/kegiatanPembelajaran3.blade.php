@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2>Kegiatan Pembelajaran 3</h2>
<p class="text-sm">4 JP x @50 menit = 200 menit </p>
<p><b>CPMK:</b></p>
<ol>
    <li>
        Mahasiswa mampu menyusun laporan terkait rambu-rambu wisata kesejarahan berbasis kewirausahaan berdasarkan hasil
        observasi lapangan.
    </li>
</ol>
<p class="text-lg">LAPORAN KEGIATAN</p>
<p>AKTIVITAS UNJUK KERJA</p>
<p>
    Berdasarkan hasil penilaian kelayakan objek sejarah yang dipilih dari setiap kelompok, buatlah laporan kegiatan
    tersebut dengan memuat “object pattern and feasibility”, selanjutnya diskusikan di kelas.
</p>

<!-- Form Upload Kegiatan Pembelajaran 3 -->
<form method="post" action="{{ route('uploadFileKesejarahan') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="category" value="kegiatan pembelajaran 3">
    <div class="mb-3">
        <label for="formFile1" class="form-label fw-semibold">Silahkan kumpulkan tugas untuk Kegiatan Pembelajaran
            3!</label>
        <input class="form-control" type="file" id="formFile1" name="file" accept=".pdf,application/pdf">
        <small>Kumpulkan dengan format <strong>.pdf</strong></small>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
<!-- Menampilkan File PDF -->
@if (!empty($uploadedFile))
    <div class="mt-4">
        <h5>File yang Sudah Diunggah:</h5>

        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal">
            Lihat File
        </button>

        <!-- Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed src="{{ asset('storage/' . $uploadedFile->file_path) }}" type="application/pdf" width="100%"
                            height="600px" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body mt-3">
            <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                    value="{{ $nilaiUploadKegiatanPembelajaran3->nilai_akhir ?? '' }}" {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>
            </div>
            <label for="feedbackIndividu">Feedback dari dosen</label><br>
            <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>{{ $nilaiUploadKegiatanPembelajaran3->data_jawaban_penilai ?? '' }}</textarea>
        </div>
    </div>
@endif


@endsection