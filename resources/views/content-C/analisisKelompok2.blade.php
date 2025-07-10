@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<h2>Analisis Kelompok 2</h2>
<p class="text-lg">AKTIVITAS 2</p>
<p class="text-sm">1 JP x @ 50 menit = 50 menit</p>
<p class="mt-2 text-lg">LAKUKAN ANALISA TERHADAP PERMASALAHAN BERIKUT!</p>
<p>Anggota Kelompok</p>
@if($id_kelompok !== null && $anggotaKelompok->isNotEmpty())
    <ol>
        @foreach ($anggotaKelompok as $anggota)
            <li>{{ $anggota->nama_lengkap }}</li>
        @endforeach
    </ol>
@else
    <p class="fw-bold"><i class="bi bi-exclamation-circle"></i> Tidak ada anggota kelompok ditemukan.</p>
@endif

<form action="{{ route('simpanAktivitas') }}" method="POST">
    @csrf
    <input type="hidden" name="kategori" value="aktivitas 2">
    <ul class="list-unstyled">
        <li class="mt-3">
            <label for="jenisTeknologi" class="fw-semibold">Jenis-jenis teknologi yang berpengaruh terhadap dunia
                pemasaran produkproduk yang berkaitan dengan kewirausahaan kesejarahan:</label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[JenisTeknologi]" id="jenisTeknologi"
                rows="5">{{ old('jawaban.JenisTeknologi', $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Jenis-jenis teknologi')->first()->jawaban ?? '') }}</textarea>
        </li>
        <li class="mt-3">
            <label for="pengaruhTeknologi" class="fw-semibold">Bagaimana pengaruh teknologi tersebut terhadap proses
                pemasaran kewirausahaan kesejarahan:</label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[pengaruhTeknologi]" id="pengaruhTeknologi"
                rows="5">{{ old('jawaban.pengaruhTeknologi', $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Pengaruh Teknologi')->first()->jawaban ?? '') }}</textarea>
        </li>
        <li class="mt-3">
            <label for="kelebihanKekuranganTeknologi" class="fw-semibold">Kelebihan dan kekurangan penggunaan teknologi
                dalam proses pemasaran kewirausahaan kesejarahan:</label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[kelebihanKekuranganTeknologi]"
                id="kelebihanKekuranganTeknologi"
                rows="5">{{ old('jawaban.kelebihanKekuranganTeknologi', $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Kelebihan dan Kekurangan penggunaan teknologi')->first()->jawaban ?? '') }}</textarea>
        </li>
        <li class="mt-3">
            <label for="kondisiProses" class="fw-semibold">Analisislah kondisi proses pemasaran sebelum dan sesudah
                ditemukannya teknologi khususnya platform pemasaran digital:</label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[kondisiProses]" id="kondisiProses"
                rows="5">{{ old('jawaban.kondisiProses', $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'kondisi proses sebelum dan sesudah')->first()->jawaban ?? '') }}</textarea>
        </li>
    </ul>
    <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
</form>

@if(
        !empty($jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Jenis-jenis teknologi')->first()?->jawaban  &&
        $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Pengaruh Teknologi')->first()?->jawaban &&
        $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'Kelebihan dan Kekurangan penggunaan teknologi')->first()?->jawaban &&
        $jawabanKelompok->where('kategori', 'aktivitas 2')->where('aspek', 'kondisi proses sebelum dan sesudah')->first()?->jawaban)
    )
    <div class="card-body mt-3">
        <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
            <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                value="{{ $nilaiKelompokAktivitas2->nilai_akhir ?? '' }}" {{ $nilaiKelompokAktivitas2 ? 'disabled' : '' }}>
        </div>
        <label for="feedbackIndividu">Feedback dari dosen</label><br>
        <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiKelompokAktivitas2 ? 'disabled' : '' }}>{{ $nilaiKelompokAktivitas2->data_jawaban_penilai ?? '' }}</textarea>
    </div>
@endif

@endsection