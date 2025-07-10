@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2>Praktik Lapangan 2</h2>
<p class="text-lg">AKTIVITAS 6</p>
<p class="text-sm">2 JP x @ 50 menit = 100 menit</p>
<p>
    Pada pertemuan kali ini, saatnya kalian menjual produk dan jasa terkait kewirausahaan kesejarahan yang telah kalian rancang kepada lingkup yang lebih luas, seperti masyarakat umum, teman di luar kelas/fakultas, teman di luar universitas, pengguna sosial media, dan lainlain. Tulislah produk dan yang berhasil kalian jual beserta jumlahnya.
</p>

<!-- Form Upload Praktik Lapangan 2 -->
<form method="post" action="{{ route('uploadFileKesejarahan') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="category" value="praktik lapangan 2">
    <div class="mb-3">
        <label for="formFile1" class="form-label fw-semibold">Silahkan kumpulkan tugas untuk Praktik Lapangan 2!</label>
        <input class="form-control" type="file" id="formFile1" name="file" accept=".pdf,application/pdf">
        <small>Kumpulkan dengan format <strong>.pdf</strong></small>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>

<h4 class="text-center my-3">Lampiran: <br> Tabel jumlah produk dan jasa yang terjual</h4>
<table class="shadow table table-bordered">
    <thead>
        <th>No</th>
        <th>Nama Konsumen</th>
        <th>Jumlah</th>
        <th>Keterengan</th>
    </thead>
    <tr>
        <td>1.</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>2.</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>3.</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>dst.</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
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
                        <embed src="{{ asset('storage/' . $uploadedFile->file_path) }}" 
                               type="application/pdf" 
                               width="100%" 
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
                    value="{{ $nilaiUploadAktivitas2->nilai_akhir ?? '' }}" {{ $nilaiUploadAktivitas2 ? 'disabled' : '' }}>
            </div>
            <label for="feedbackIndividu">Feedback dari dosen</label><br>
            <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiUploadAktivitas2 ? 'disabled' : '' }}>{{ $nilaiUploadAktivitas2->data_jawaban_penilai ?? '' }}</textarea>
        </div>
    </div>
@endif

@endsection