@extends('layouts.main')

@section('container-content')
    <div class="content py-4">

        {{-- 🌟 Bagian Judul Utama --}}
        <div class="mb-5">
            <h2 class="fw-bold">Hasil Belajar Anda</h2>
            <p class="text-muted">Berikut rekap hasil evaluasi dan tugas yang telah Anda selesaikan.</p>
        </div>

        @php
            $dataBelajar = $dataNilai->where('tipe', null);
            $dataUpload = $dataNilai->where('tipe', 'file_upload');
        @endphp

        {{-- 📚 Bagian Evaluasi --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-gradient bg-dark  text-white">
                <h5 class="mb-0"><i class="bi bi-journal-check me-2"></i>Hasil Evaluasi Pilihan Ganda</h5>
            </div>
            <div class="card-body">
                @if ($dataBelajar->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Aspek Penilaian</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBelajar as $nilai)
                                                <tr>
                                                    <td class="fw-semibold">
                                                        {{ $nilai->aspek == 'analisa_individu_kesejarahan_II'
                                    ? 'Analisis Kelompok Kesejarahan'
                                    : ($nilai->aspek == 'analisa_individu_kesejarahan'
                                        ? 'Analisis Individu Kesejarahan'
                                        : ($nilai->aspek == 'analisa_individu_kewirausahaan'
                                            ? 'Proyek Individu Kewirausahaan'
                                            : ucfirst(str_replace('_', ' ', $nilai->aspek)))) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge rounded-pill 
                                                                                            {{ $nilai->nilai_akhir >= 80 ? 'bg-success' : ($nilai->nilai_akhir >= 60 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                            {{ $nilai->nilai_akhir }}
                                                        </span>
                                                    </td>
                                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-2"></i>Tugas Anda belum dinilai pada bagian evaluasi.
                    </div>
                @endif
            </div>
        </div>

        {{-- 📤 Bagian Upload --}}
        @if ($dataUpload->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-cloud-arrow-up me-2"></i>Tugas Upload File</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Aktivitas Upload</th>
                                    <th>Feedback Guru</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUpload as $nilai)
                                                <tr>
                                                    <td class="fw-semibold">
                                                        {{ $nilai->aspek == 'analisa_individu_kesejarahan_II'
                                    ? 'Analisis Kelompok Kesejarahan'
                                    : ($nilai->aspek == 'analisa_individu_kesejarahan'
                                        ? 'Analisis Individu Kesejarahan'
                                        : ($nilai->aspek == 'analisa_individu_kewirausahaan'
                                            ? 'Proyek Individu Kewirausahaan'
                                            : ucfirst(str_replace('_', ' ', $nilai->aspek)))) }}
                                                    </td>
                                                    <td>{{ $nilai->data_jawaban_penilai ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge rounded-pill 
                                                                                            {{ $nilai->nilai_akhir >= 80 ? 'bg-success' : ($nilai->nilai_akhir >= 60 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                            {{ $nilai->nilai_akhir }}
                                                        </span>
                                                    </td>
                                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Optional styling --}}
    <style>
        .content {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection