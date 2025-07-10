@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2>ANALISA INDIVIDU 2</h2>
<p>
    Berdasarkan hasil identifikasi dari setiap kelompok, analisa dan asesmen lah hasil pemetaan tersebut dengan
    melengkapi kolom di bawah ini. Selanjutnya, diskusikan di kelas.
</p>
<p class="m-0">Status Pengerjaan:</p>
<ol>
    <li>Analisis Individu : <strong>{{$statusJawabanIndividu}}</strong></li>
    <li>Form Kelayakan : <strong>{{$statusFormKelayakan}}</strong></li>
</ol>
<p class="text-lg">LENGKAPILAH KOLOM DI BAWAH INI!</p>


<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="analisis-individu-tab" data-bs-toggle="tab"
            data-bs-target="#analisis-individu" type="button" role="tab" aria-controls="analisis-individu"
            aria-selected="true">Analisis Individu</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="form-kelayakan-tab" data-bs-toggle="tab" data-bs-target="#form-kelayakan"
            type="button" role="tab" aria-controls="form-kelayakan" aria-selected="false">Form Kelayakan</button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content mt-3" id="myTabContent">
    <!-- Tab Fnalisis Individu -->
    <div class="tab-pane fade show active" id="analisis-individu" role="tabpanel"
        aria-labelledby="analisis-individu-tab">
        <form method="post" action="{{ route('simpanAnalisisIndividu') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row mt-3">
                        <div class="col">
                            <label for="objekWisata" class="fw-bold">Objek Wisata</label><br>
                            <textarea name="objekWisata" id="objekWisata" class="form-control w-100 mt-2" rows="5" {{ $isDisabled ? 'disabled' : '' }}>{{ $objekWisata }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="objekKesejarahan" class="fw-bold">Objek Kesejarahan</label><br>
                            <textarea name="objekKesejarahan" id="objekKesejarahan" class="form-control w-100 mt-2"
                                rows="5" {{ $isDisabled ? 'disabled' : '' }}>{{ $objekKesejarahan }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="urgensiObjekKesejarahan" class="fw-bold">Urgensi Objek Kesejarahan</label><br>
                            <textarea name="urgensiObjekKesejarahan" id="urgensiObjekKesejarahan"
                                class="form-control w-100 mt-2" rows="5" {{ $isDisabled ? 'disabled' : '' }}>{{ $urgensiObjekKesejarahan }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="urgensiKesejarahan" class="fw-bold">Urgensi Kesejarahan</label><br>
                            <textarea name="urgensiKesejarahan" id="urgensiKesejarahan" class="form-control w-100 mt-2"
                                rows="5" {{ $isDisabled ? 'disabled' : '' }}>{{ $urgensiKesejarahan }}</textarea>
                        </div>
                    </div>
                    <p class="border rounded p-2 bg-warning-subtle mt-4 fw-semibold">
                        Note: Tugas ini tidak dapat di edit setelah disimpan
                    </p>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" {{ $isDisabled ? 'hidden' : '' }}>Kirim
                                Jawaban</button>
                        </div>
                    </div>
                    @if (!empty($objekWisata && $objekKesejarahan && $urgensiObjekKesejarahan && $urgensiKesejarahan))
                        <div class="card-body mt-3">
                            <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    value="{{ $nilaiJawabanIndividuKesejarahanII->nilai_akhir ?? '' }}" {{ $nilaiJawabanIndividuKesejarahanII ? 'disabled' : '' }}>
                            </div>
                            <label for="feedbackIndividu">Feedback dari dosen</label><br>
                            <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu"
                                rows="5" {{ $nilaiJawabanIndividuKesejarahanII ? 'disabled' : '' }}>{{ $nilaiJawabanIndividuKesejarahanII->data_jawaban_penilai ?? '' }}</textarea>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Tab Form Kelayakan -->
    <div class="tab-pane fade" id="form-kelayakan" role="tabpanel" aria-labelledby="form-kelayakan-tab">
        <div class="">
            <h4 class="text-center  mb-3">INDIKATOR PENILAIAN KELAYAKAN OBJEK KESEJARAHAN </h4>
            <table class="shadow table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aspek</th>
                        <th>Bobot</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tr>
                    <td>1.</td>
                    <td>Daya Tarik</td>
                    <td>6</td>
                    <td>Daya tarik merupakan faktor utama
                        alasan seseorang melakukan
                        perjalanan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Aksesibilitas</td>
                    <td>5</td>
                    <td>Aksesbilitas merupakan faktor penting
                        yang mendukung wisatawan dapat
                        melakukan kegiatan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Sarana Prasarana</td>
                    <td>3</td>
                    <td>Sarana dan prasarana bersifat
                        sebagai penunjang dalam kegiatan
                        wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Partisipasi Masyarakat</td>
                    <td>6</td>
                    <td>Partisipasi masyarakat adalah
                        keterlibatan sukarela oleh masyarakat
                        dalam pembangunan objek sejarah di
                        lingkungan mereka sendiri.</td>
                </tr>
            </table>
        </div>

        <div class="mt-4">
            <form method="post" action="{{route('simpanFormKelayakan')}}">
                @csrf
                <h4 class="text-center mt-4 mb-3">FORM SYARAT KELAYAKAN OBJEK KESEJARAHAN</h4>
                <table class="shadow table table-bordered  table-responsive-md">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2">NO</th>
                            <th rowspan="2">ASPEK</th>
                            <th rowspan="2">Sub Aspek</th>
                            <th colspan="5">Skor</th>
                            <th rowspan="2">Alasan</th>
                        </tr>
                        <tr class="text-center">
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tr>
                        <td rowspan="4">1.</td>
                        <td rowspan="4">Daya Tarik</td>
                        <td>1. Memiliki keunikan atau ciri khas sejarah lokal</td>
                        <td><input type="radio" class="form-check-input" name="nomor1-1" id="no2-1" value="2-1"
                                {{$formKelayakanDayaTarik1_1_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-1" id="no2-2" value="2-2"
                                {{$formKelayakanDayaTarik1_1_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-1" id="no2-3" value="2-3"
                                {{$formKelayakanDayaTarik1_1_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-1" id="no2-4" value="2-4"
                                {{$formKelayakanDayaTarik1_1_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-1" id="no2-5" value="2-5"
                                {{$formKelayakanDayaTarik1_1_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan1-1" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanDayaTarik1_1_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>2. Objek sejarah memiliki lokasi yang bersih</td>
                        <td><input type="radio" class="form-check-input" name="nomor1-2" id="no2-1" value="2-1"
                                {{$formKelayakanDayaTarik1_2_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-2" id="no2-2" value="2-2"
                                {{$formKelayakanDayaTarik1_2_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-2" id="no2-3" value="2-3"
                                {{$formKelayakanDayaTarik1_2_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-2" id="no2-4" value="2-4"
                                {{$formKelayakanDayaTarik1_2_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-2" id="no2-5" value="2-5"
                                {{$formKelayakanDayaTarik1_2_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan1-2" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanDayaTarik1_2_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>3. Kawasan objek sejarah terjamin keamanannya</td>
                        <td><input type="radio" class="form-check-input" name="nomor1-3" id="no2-1" value="2-1"
                                {{$formKelayakanDayaTarik1_3_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-3" id="no2-2" value="2-2"
                                {{$formKelayakanDayaTarik1_3_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-3" id="no2-3" value="2-3"
                                {{$formKelayakanDayaTarik1_3_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-3" id="no2-4" value="2-4"
                                {{$formKelayakanDayaTarik1_3_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-3" id="no2-5" value="2-5"
                                {{$formKelayakanDayaTarik1_3_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan1-3" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanDayaTarik1_3_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>4. Keserasian bangunan objek dengan lingkungan</td>
                        <td><input type="radio" class="form-check-input" name="nomor1-4" id="no2-1" value="2-1"
                                {{$formKelayakanDayaTarik1_4_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-4" id="no2-2" value="2-2"
                                {{$formKelayakanDayaTarik1_4_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-4" id="no2-3" value="2-3"
                                {{$formKelayakanDayaTarik1_4_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-4" id="no2-4" value="2-4"
                                {{$formKelayakanDayaTarik1_4_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor1-4" id="no2-5" value="2-5"
                                {{$formKelayakanDayaTarik1_4_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan1-4" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanDayaTarik1_4_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td rowspan="3">2.</td>
                        <td rowspan="3">Aksesbilitas</td>
                        <td>1. Kondisi jalan menuju objek sejarah terlampau mulus</td>
                        <td><input type="radio" class="form-check-input" name="nomor2-1" id="no2-1" value="2-1"
                                {{$formKelayakanAksesbilitas2_1_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-1" id="no2-2" value="2-2"
                                {{$formKelayakanAksesbilitas2_1_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-1" id="no2-3" value="2-3"
                                {{$formKelayakanAksesbilitas2_1_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-1" id="no2-4" value="2-4"
                                {{$formKelayakanAksesbilitas2_1_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-1" id="no2-5" value="2-5"
                                {{$formKelayakanAksesbilitas2_1_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan2-1" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanAksesbilitas2_1_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>2. Dekat dari pusat kota</td>
                        <td><input type="radio" class="form-check-input" name="nomor2-2" id="no2-1" value="2-1"
                                {{$formKelayakanAksesbilitas2_2_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-2" id="no2-2" value="2-2"
                                {{$formKelayakanAksesbilitas2_2_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-2" id="no2-3" value="2-3"
                                {{$formKelayakanAksesbilitas2_2_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-2" id="no2-4" value="2-4"
                                {{$formKelayakanAksesbilitas2_2_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-2" id="no2-5" value="2-5"
                                {{$formKelayakanAksesbilitas2_2_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan2-2" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanAksesbilitas2_2_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>3. Waktu tempuh dari pusat kota tidak terlalu lama/jauh</td>
                        <td><input type="radio" class="form-check-input" name="nomor2-3" id="no2-1" value="2-1"
                                {{$formKelayakanAksesbilitas2_3_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-3" id="no2-2" value="2-2"
                                {{$formKelayakanAksesbilitas2_3_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-3" id="no2-3" value="2-3"
                                {{$formKelayakanAksesbilitas2_3_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-3" id="no2-4" value="2-4"
                                {{$formKelayakanAksesbilitas2_3_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor2-3" id="no2-5" value="2-5"
                                {{$formKelayakanAksesbilitas2_3_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan2-3" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanAksesbilitas2_3_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td rowspan="4">3.</td>
                        <td rowspan="4">Sarana Prasarana</td>
                        <td>1. Memiliki fasilitas umum seperti toilet dan tempat wudhu</td>
                        <td><input type="radio" class="form-check-input" name="nomor3-1" id="no2-1" value="2-1"
                                {{$formKelayakanSaranaDanPrasarana3_1_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-1" id="no2-2" value="2-2"
                                {{$formKelayakanSaranaDanPrasarana3_1_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-1" id="no2-3" value="2-3"
                                {{$formKelayakanSaranaDanPrasarana3_1_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-1" id="no2-4" value="2-4"
                                {{$formKelayakanSaranaDanPrasarana3_1_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-1" id="no2-5" value="2-5"
                                {{$formKelayakanSaranaDanPrasarana3_1_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan3-1" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanSaranaDanPrasarana3_1_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>2. Memiliki <i>gif/merchandise store</i> di sekitar objek sejarah</td>
                        <td><input type="radio" class="form-check-input" name="nomor3-2" id="no2-1" value="2-1"
                                {{$formKelayakanSaranaDanPrasarana3_2_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-2" id="no2-2" value="2-2"
                                {{$formKelayakanSaranaDanPrasarana3_2_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-2" id="no2-3" value="2-3"
                                {{$formKelayakanSaranaDanPrasarana3_2_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-2" id="no2-4" value="2-4"
                                {{$formKelayakanSaranaDanPrasarana3_2_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-2" id="no2-5" value="2-5"
                                {{$formKelayakanSaranaDanPrasarana3_2_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan3-2" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanSaranaDanPrasarana3_2_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>3. Memiliki warung dan rumah makan di sekitar objek sejarah</td>
                        <td><input type="radio" class="form-check-input" name="nomor3-3" id="no2-1" value="2-1"
                                {{$formKelayakanSaranaDanPrasarana3_3_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-3" id="no2-2" value="2-2"
                                {{$formKelayakanSaranaDanPrasarana3_3_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-3" id="no2-3" value="2-3"
                                {{$formKelayakanSaranaDanPrasarana3_3_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-3" id="no2-4" value="2-4"
                                {{$formKelayakanSaranaDanPrasarana3_3_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-3" id="no2-5" value="2-5"
                                {{$formKelayakanSaranaDanPrasarana3_3_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan3-3" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanSaranaDanPrasarana3_3_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>4. Memiliki areal parkir yang cukup untuk wisatawan</td>
                        <td><input type="radio" class="form-check-input" name="nomor3-4" id="no2-1" value="2-1"
                                {{$formKelayakanSaranaDanPrasarana3_4_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-4" id="no2-2" value="2-2"
                                {{$formKelayakanSaranaDanPrasarana3_4_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-4" id="no2-3" value="2-3"
                                {{$formKelayakanSaranaDanPrasarana3_4_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-4" id="no2-4" value="2-4"
                                {{$formKelayakanSaranaDanPrasarana3_4_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor3-4" id="no2-5" value="2-5"
                                {{$formKelayakanSaranaDanPrasarana3_4_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan3-4" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanSaranaDanPrasarana3_4_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td rowspan="7">4.</td>
                        <td rowspan="7">Partisipasi Masyarakat</td>
                        <td>1. Objek kesejarahan dapat mensejahterakan tuan rumah atau masyarakat sekitar</td>
                        <td><input type="radio" class="form-check-input" name="nomor4-1" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_1_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-1" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_1_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-1" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_1_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-1" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_1_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-1" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_1_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-1" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_1_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>2. Masyarakat sekitar menyambut kehadiran wisatawan</td>
                        <td><input type="radio" class="form-check-input" name="nomor4-2" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_2_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-2" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_2_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-2" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_2_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-2" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_2_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-2" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_2_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-2" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_2_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>3. Masyarakat menyediakan fasilitas kenyamanan wisata</td>
                        <td><input type="radio" class="form-check-input" name="nomor4-3" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_3_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-3" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_3_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-3" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_3_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-3" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_3_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-3" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_3_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-3" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_3_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>4. Masyarakat menyediakan pemandu wisata</td>
                        <td><input type="radio" class="form-check-input" name="nomor4-4" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_4_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-4" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_4_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-4" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_4_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-4" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_4_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-4" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_4_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-4" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_4_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>5. Pelaku wisata berasal dari masyarakat lokal</td>
                        <td><input type="radio" class="form-check-input" name="nomor4-5" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_5_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-5" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_5_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-5" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_5_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-5" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_5_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-5" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_5_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-5" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_5_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>6. Terdapat penjual cindremata/oleh-oleh khas wisata setempat yang dibuat masyarakat lokal
                        </td>
                        <td><input type="radio" class="form-check-input" name="nomor4-6" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_6_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-6" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_6_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-6" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_6_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-6" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_6_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-6" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_6_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-6" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_6_reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td>7. Masyarakat turut serta dalam menjaga keamanan, kenyamanan, ketertiban, dan kebersihan
                            daerah wisata
                        </td>
                        <td><input type="radio" class="form-check-input" name="nomor4-7" id="no2-1" value="2-1"
                                {{$formKelayakanPartisipasiMasyarakat4_7_score == 1 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-7" id="no2-2" value="2-2"
                                {{$formKelayakanPartisipasiMasyarakat4_7_score == 2 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-7" id="no2-3" value="2-3"
                                {{$formKelayakanPartisipasiMasyarakat4_7_score == 3 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-7" id="no2-4" value="2-4"
                                {{$formKelayakanPartisipasiMasyarakat4_7_score == 4 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><input type="radio" class="form-check-input" name="nomor4-7" id="no2-5" value="2-5"
                                {{$formKelayakanPartisipasiMasyarakat4_7_score == 5 ? 'checked' : ''}} {{ $isDisabledForm ? 'disabled' : '' }}></td>
                        <td><textarea name="alasan4-7" class="form-control" rows="3" {{ $isDisabledForm ? 'disabled' : '' }}>{{ $formKelayakanPartisipasiMasyarakat4_7_reason }}</textarea></td>
                    </tr>
                </table>
                <p class="border rounded p-2 bg-warning-subtle mt-4 fw-semibold">
                    Note: Tugas ini tidak dapat di edit setelah disimpan
                </p>
                <button type="submit" class="btn btn-primary" {{ $isDisabledForm ? 'hidden' : '' }}>Simpan
                    Jawaban</button>
            </form>
        </div>
    </div>
</div>

@endsection