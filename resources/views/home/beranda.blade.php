@extends('layouts.home')

@section('container')


    <div class="d-md-flex flex-md-row-reverse text-center text-md-start align-items-center justify-content-between">
        <img src="{{ asset('img/histoprener.gif') }}" alt="Landing Page Ilustration" width="500" height="500"
            decoding="async" class="img-fluid p-3">
        <div class="d-flex flex-column gap-3">
            <div>
                <h2 class="fw-semibold text-primary">SELAMAT DATANG DI</h2>
                <h3>MEDIA PEMBELAJARAN INTERAKTIF HISTORIOPRENEURSHIP</h3>
            </div>
            <p class="text-muted lead">"Menggabungkan Sejarah dan Kewirausahaan dalam Pengalaman Belajar yang Seru dan
                Interaktif"</p>
            <div class="d-flex flex-column flex-md-row gap-3">
                @if (Auth::check())
                    @if (auth()->user()->peran == 'siswa')
                        <a role="button" tabindex="0" class="btn btn-primary btn-lg" href="/dashboard">MULAI BELAJAR</a>
                    @elseif(auth()->user()->peran == 'guru')
                        <a role="button" tabindex="0" class="btn btn-outline-primary btn-lg"
                            href="/guru/dashboard">HALAMAN GURU</a>
                    @else
                        <a role="button" tabindex="0" class="btn btn-outline-primary btn-lg"
                            href="/admin/dashboard">HALAMAN ADMIN</a>
                    @endif
                @else
                    <a role="button" tabindex="0" class="btn btn-primary btn-lg" href="/masuk">MULAI BELAJAR</a>
                @endif
            </div>
        </div>
    </div>

@endsection
