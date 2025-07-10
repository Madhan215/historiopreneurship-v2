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

<h2>Analisis Kelompok 1</h2>
<p class="text-lg">AKTIVITAS 1</p>
<p class="text-sm">1 JP x @ 50 menit = 50 menit</p>
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

<p class="mt-2 text-lg">
    DESKRIPSIKANLAH PERSPEKTIF KALIAN TERHADAP PERMASALAHAN BERIKUT!
</p>
<p>
    Perkembangan teknologi semakin hari semakin bertambah canggih. Dengan ditemukannya berbagai macam jenis software
    atau aplikasi serta pemrograman internet, membawa pengaruh yang sangat besar terhadap isu perdagangan dan pemasaran
    dari strategi offline ke startegi berbasis online. Pemasaran Online atau bisa disebut juga dengan Digital Marketing
    merupakan teknik pemasaran terkini dengan menggunakan internet sebagai sumber utamanya. Selain bisa menjangkau ke
    seluruh dunia, pemasaran online bisa dilakukan hanya di depan komputer dan tentunya memerlukan strategi-strategi
    terstentu untuk bisa menyukseskan proses pemasarannya.
</p>
<p>
    Strategi-startegi yang bisa dilakukan dalam pemasaran berbasis online dapat menggunakan berbagai macam software,
    aplikasi atau program, baik yang disedikan secara organik (gratis) maupun anorganik (berbayar). Saat ini tersedia
    berbagai macam platform aplikasi yang dapat digunakan sebagai media atau tools untuk meningkatkan strategi
    pemasaran, diantaranya SEO, SEM, Social media marketing (Facebook, Instagram, whatsapp, twitter, dan lain-lain),
    PPC, dan Afiliate marketing
</p>
<h4 class="text-center">
    PENGALAMAN BERBELANJA PADA SITUS e-COMMERCE
</h4>

<form action="{{ route('simpanAktivitas') }}" method="POST">
    @csrf
    <input type="hidden" name="kategori" value="aktivitas 1">
    <ol class="list-unstyled">
        <li class="mt-3">
            <label for="pengalaman" class="fw-semibold">Pengalaman yang didapat:</label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[pengalaman]" id="pengalaman"
                rows="5">{{ old('jawaban.pengalaman', $jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'Pengalaman yang didapat')->first()->jawaban ?? '') }}</textarea>
        </li>
        <li class="mt-3">
            <label for="kelebihan" class="fw-semibold">Kelebihan berbelanja melalui situs <i>e-commerce:</i></label>
            <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[kelebihan]" id="kelebihan"
                rows="5">{{ old('jawaban.kelebihan', $jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'kelebihan e-commerce')->first()->jawaban ?? '') }}</textarea>
        </li>
        <li class="mt-3">
            <label for="kekurangan" class="fw-semibold">Kekurangan belanja melalui situs <i>e-commerce:</i></label> <br>
            <textarea class="form-control w-100 mt-2" name="jawaban[kekurangan]" id="kekurangan"
                rows="5">{{ old('jawaban.kekurangan', $jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'kekurangan e-commerce')->first()->jawaban ?? '') }}</textarea>
        </li>
    </ol>
    <button type="submit" class="btn btn-primary mt-3">Simpan Jawaban</button>
</form>

@if(
        !empty($jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'Pengalaman yang didapat')->first()?->jawaban &&
        $jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'kelebihan e-commerce')->first()?->jawaban &&
        $jawabanKelompok->where('kategori', 'aktivitas 1')->where('aspek', 'kekurangan e-commerce')->first()?->jawaban)
    )
    <div class="card-body mt-3">
        <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
            <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                value="{{ $nilaiKelompokAktivitas1->nilai_akhir ?? '' }}" {{ $nilaiKelompokAktivitas1 ? 'disabled' : '' }}>
        </div>
        <label for="feedbackIndividu">Feedback dari dosen</label><br>
        <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiKelompokAktivitas1 ? 'disabled' : '' }}>{{ $nilaiKelompokAktivitas1->data_jawaban_penilai ?? '' }}</textarea>
    </div>
@endif

@endsection