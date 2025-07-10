@extends('layouts.home')

@section('container')
<h1>Daftar Isi Materi</h1>
<div class="my-3 g-3 row">
    <div class="col-lg-4">
        <div class="h-100 card">
            <div class="card-body">
                <div class="card-title h5">
                    A.
                </div>
                <div class="mb-2 text-muted card-subtitle h6">
                    Informasi Umum
                </div>
                <ul>
                    <li><p class="m-0 small card-text">CPL</p></li>
                    <li><p class="m-0 small card-text">CPMK</p></li>
                    <li><p class="m-0 small card-text">Peran Dosen</p></li>
                    <li><p class="m-0 small card-text">Sarana dan Prasarana</p></li>
                    <li><p class="m-0 small card-text">Kolaborasi Narasumber</p></li>
                    <li><p class="m-0 small card-text">Cara Penggunaan</p></li>
                    <li><p class="m-0 small card-text">Tahapan</p></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="h-100 card">
            <div class="card-body">
                <div class="card-title h5">
                    B.
                </div>
                <div class="mb-2 text-muted card-subtitle h6">
                    Kesejarahan
                </div>
                <ul>
                    <li><p class="m-0 small card-text">Pre-Test</p></li>
                    <li><p class="m-0 small card-text">Kegiatan Pembelajaran 1</p></li>
                    <li><p class="m-0 small card-text">Kuis Kesejarahan</p></li>
                    <li><p class="m-0 small card-text">Kegiatan Pembelajaran 2</p></li>
                    <li><p class="m-0 small card-text">Analisis Kelompok</p></li>
                    <li><p class="m-0 small card-text">Analisis Individu</p></li>
                    <li><p class="m-0 small card-text">Kegiatan Pembelajaran 3</p></li>
                    <li><p class="m-0 small card-text">Post-Test</p></li>
                    <li><p class="m-0 small card-text">Refleksi</p></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="h-100 card">
            <div class="card-body">
                <div class="card-title h5">
                    C.
                </div>
                <div class="mb-2 text-muted card-subtitle h6">
                    Kewirausahaan & Kesejarahan
                </div>
                <ul>
                    <li><p class="m-0 small card-text">Pre-Test</p></li>
                    <li><p class="m-0 small card-text">KWU & Kepariwisataan</p></li>
                    <li><p class="m-0 small card-text">Kuis KWU & Kepariwisataan</p></li>
                    <li><p class="m-0 small card-text">Analisis Kelompok 1</p></li>
                    <li><p class="m-0 small card-text">Analisis Kelompok 2</p></li>
                    <li><p class="m-0 small card-text">Diskusi Kelompok</p></li>
                    <li><p class="m-0 small card-text">Proyek Individu</p></li>
                    <li><p class="m-0 small card-text">Refleksi 1</p></li>
                    <li><p class="m-0 small card-text">Praktik Lapangan 1</p></li>
                    <li><p class="m-0 small card-text">Praktik Lapangan 2</p></li>
                    <li><p class="m-0 small card-text">Post-Test</p></li>
                    <li><p class="m-0 small card-text">Refleksi</p></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/showPass.js')}}"></script>

@endsection