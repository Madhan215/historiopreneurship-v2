@extends('layouts.main')

@section('container-content')
    <h1>Dashboard Guru</h1>

    <div class="row align-items-stretch">
        <!-- Kolom Kiri: Profil -->
        <div class="col-6 d-flex">
            <div class="card shadow-sm flex-fill">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title mb-3">Profil Guru</h5>
                    <div class="d-flex align-items-center">
                        <!-- Foto Profil -->
                        <img src="{{ auth()->user()->profilePhotoUrl }}" alt="Profile Photo"
                            class="rounded-circle border border-primary me-3"
                            style="width: 80px; height: 80px; object-fit: cover;">

                        <!-- Info Profil -->
                        <div>
                            <p class="mb-1"><strong>Role:</strong> {{ auth()->user()->peran }}</p>
                            <p class="mb-1"><strong>Nama:</strong> {{ auth()->user()->nama_lengkap }}</p>
                            <p class="mb-0"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Jumlah Kelas & Siswa -->
        <div class="col-6 d-flex flex-column justify-content-between">
            <div class="card shadow-sm flex-fill mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jumlah Kelas Diampu</h5>
                    <p class="card-text fs-4 fw-bold mb-0 text-end">{{ $jumlahKelasDiampu }}</p>
                </div>
            </div>
            <div class="card shadow-sm flex-fill">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jumlah Siswa</h5>
                    <p class="card-text fs-4 fw-bold mb-0 text-end">{{ $jumlahSiswa }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
