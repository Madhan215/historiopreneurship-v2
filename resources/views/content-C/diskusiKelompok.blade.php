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

<h2>Diskusi Kelompok</h2>
<p class="text-lg">AKTIVITAS 3</p>
<p class="text-sm">2 JP x @ 50 menit = 100 menit</p>
<p class="mt-2">
    Berdasarkan materi yang disampaikan oleh pakar, diskusikanlah materi tersebut dengan menguraikan perspektif kalian dalam bentuk ringkasan dan peta konsep terkait pemasaran kewirausahaan kesejarahan!
</p>
<p>
    <b>RINGKASAN DAN PETA KONSEP PEMASARAN KEWIRAUSAHAAN KESEJARAHAN</b>
</p>
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

{{-- Disini Backend --}}
<form  action="{{ route('simpanAktivitas') }}" method="POST">
    @csrf
    <input type="hidden" name="kategori" value="aktivitas 3">
    <label for="analisaKelompok" class="fw-semibold">Hasil analisa kelompok:</label> 
    <textarea class="form-control w-100 my-2" name="jawaban[analisaKelompok]" id="analisaKelompok" rows="5" placeholder="Tuliskan hasil analisa kelompok disini">{{ old('jawaban.analisaKelompok', $jawabanKelompok->where('kategori', 'aktivitas 3')->where('aspek', 'Hasil analisa kelompok')->first()->jawaban ?? '') }}</textarea>

    <button type="submit" class="btn btn-primary my-3">Simpan Jawaban</button>
    
</form>

<h3>Rubrik Hasil Analisa</h3>
<ol>
    <li>
        <b>KATEGORI 1</b><br>Jika hasil analisa mengambarkan jawaban yang tidak lengkap, tidak terstruktur dan tidak tepat sasaran 
    </li>
    <li class="mt-3">
        <b>KATEGORI 2</b><br>Jika hasil analisa mengambarkan jawaban yang cukup lengkap, cukup terstruktur dan cukup tepat sasaran 
    </li>
    <li class="mt-3">
        <b>KATEGORI 3</b><br>Jika hasil analisa mengambarkan jawaban yang lengkap, terstruktur dan tepat sasaran 
    </li>
    <li class="mt-3">
        <b>KATEGORI 4</b><br>Jika hasil analisa mengambarkan jawaban yang sangat lengkap, sangat terstruktur dan sangat tepat sasaran 
    </li>
</ol>

@if(
        !empty($jawabanKelompok->where('kategori', 'aktivitas 3')->where('aspek', 'Hasil analisa kelompok')->first()?->jawaban)
    )
    <div class="card-body mt-3">
        <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
            <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                value="{{ $nilaiKelompokAktivitas3->nilai_akhir ?? '' }}" {{ $nilaiKelompokAktivitas3 ? 'disabled' : '' }}>
        </div>
        <label for="feedbackIndividu">Feedback dari dosen</label><br>
        <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiKelompokAktivitas3 ? 'disabled' : '' }}>{{ $nilaiKelompokAktivitas3->data_jawaban_penilai ?? '' }}</textarea>
    </div>
@endif

@endsection