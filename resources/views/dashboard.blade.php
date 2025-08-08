@extends('layouts.main')

@section('container-content')
    <style>
        .badge-img {
            transition: transform 0.2s ease-in-out;
        }

        .badge-img:hover {
            transform: scale(1.2);
            cursor: pointer;
        }

        .grayscale {
            filter: grayscale(100%);
        }
    </style>

    <h1>Dashboard</h1>
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <strong><i class="bi bi-info-circle"></i> Panduan Penggunaan Media</strong>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="mb-0">
                            <li>Pelajari materi dan ikuti petunjuk secara berurutan.</li>
                            <li>Selesaikan aktivitas pada sub bab untuk membuka sub berikutnya.</li>
                            <li>Sub bab terkunci ditandai dengan ikon gembok <i class="bi bi-lock"></i>.</li>
                            <li>Tombol <strong>Selanjutnya</strong> aktif jika aktivitas sub bab diselesaikan.</li>
                            <li>Setiap akhir bab ada evaluasi, KKM 70 untuk melanjutkan ke bab berikutnya.</li>
                            <li>Setelah semua bab selesai, ikuti evaluasi akhir untuk mendapat sertifikat.</li>
                            <li>Kumpulkan poin tertinggi untuk naik peringkat di leaderboard 🏆.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <!-- Card 1: Progress Pembelajaran -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Profil Kamu</h5>
                        <div class=" d-flex align-items-center">
                            <!-- Foto Profil di Kiri -->
                            {{-- <img src="{{ auth()->user()->profilePhotoUrl }}" alt="Profile Photo"
                                class="rounded-circle border border-primary me-3"
                                style="width: 80px; height: 80px; object-fit: cover;"> --}}

                            <a href="{{ auth()->user()->profilePhotoUrl }}" data-fancybox
                                data-caption="{{ auth()->user()->name }}">
                                <img class="rounded-circle border border-primary me-3"
                                    src="{{ auth()->user()->profilePhotoUrl }}" alt="{{ auth()->user()->name }}"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            </a>

                            <!-- Informasi Profil di Kanan -->
                            <div>
                                <p class="mb-1"><strong>Peran:</strong> {{ auth()->user()->peran }}</p>
                                <p class="mb-1"><strong>Nama:</strong> {{ auth()->user()->nama_lengkap }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Card 2: Profil -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Perolehan Badge</h5>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            {{-- @foreach ($badges as $badge)
                                <img src="{{ asset($badge->url) }}" alt="Badge {{ $badge->name }}"
                                    class="rounded-circle badge-img {{ $badge->earned_at ? '' : 'grayscale' }}"
                                    width="70" data-bs-toggle="tooltip"
                                    title="{{ $badge->earned_at ? $badge->info . ' (Diperoleh pada: ' . $badge->earned_at . ')' : $badge->how }}">
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Perolehan Poin -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title mb-2">Progress Pembelajaran</h5>
                        <div class="progress mt-2 w-100">
                            {{-- <div role="progressbar"
                                class="progress-bar bg-primary progress-bar-striped progress-bar-animated fw-semibold"
                                aria-valuenow="{{ ($progressCompleted / 32) * 100 }}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ ($progressCompleted / 32) * 100 }}%;">
                                {{ number_format(($progressCompleted / 32) * 100, 2) }}%
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>

            <!-- Card 4: Perolehan Badge -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Perolehan Poin</h5>
                        <h4 class="fw-semibold text-primary">3487</h4>
                        {{-- <h4 class="fw-semibold text-primary">{{ $totalPoints }}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        Fancybox.bind("[data-fancybox]", {
            Toolbar: {
                display: ["close"] // Hanya tombol close
            },
            animated: true,
            dragToClose: true,
            showClass: "fancybox-zoomIn",
            hideClass: "fancybox-zoomOut",
        });
    </script>
@endsection
