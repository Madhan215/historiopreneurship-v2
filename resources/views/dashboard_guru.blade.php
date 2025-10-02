@extends('layouts.main')

@section('container-content')
    <h1>Dashboard Guru</h1>

    <div class="row">
        <!-- Kolom pertama: Full Width -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Profil Guru</h5>
                    <div class=" d-flex align-items-center">
                        <!-- Foto Profil di Kiri -->
                        <img src="{{ auth()->user()->profilePhotoUrl }}" alt="Profile Photo"
                            class="rounded-circle border border-primary me-3"
                            style="width: 80px; height: 80px; object-fit: cover;">

                        <!-- Informasi Profil di Kanan -->
                        <div>
                            <p class="mb-1"><strong>Role:</strong> {{ auth()->user()->role }}</p>
                            <p class="mb-1"><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Jumlah kelas diampu</h5>
                    <p class="card-text">{{ $jumlahKelasDiampu }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Jumlah siswa</h5>
                    <p class="card-text">{{ $jumlahSiswa }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
