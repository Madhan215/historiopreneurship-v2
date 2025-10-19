@extends('layouts.main')

@section('container-content')
    <style>
        /* Grid layout: 2 kolom, 3 baris; kolom kanan span 3 baris */
        .card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(3,
                    minmax(120px, auto));
            /* tiap kotak kiri minimal tinggi 120px */
            gap: 1rem;
            align-items: stretch;
        }

        /* Buat card kanan membentang dari baris 1 sampai 4 (span 3 baris) */
        .card-right {
            grid-column: 2 / 3;
            grid-row: 1 / 4;
            height: 100%;
            /* ambil seluruh tinggi yang tersedia */
        }

        /* Kotak-kotak kiri menempati kolom 1 dan masing-masing barisnya */
        .card-left-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }

        .card-left-2 {
            grid-column: 1 / 2;
            grid-row: 2 / 3;
        }

        .card-left-3 {
            grid-column: 1 / 2;
            grid-row: 3 / 4;
        }

        /* Supaya isi card kanan bisa men-scroll bila panjang */
        .card-right .card-body {
            overflow: auto;
        }

        /* Responsive: pada layar kecil jadi satu kolom (stack) */
        @media (max-width: 767.98px) {
            .card-grid {
                grid-template-columns: 1fr;
                grid-template-rows: none;
            }

            .card-right {
                grid-column: 1 / 2;
                grid-row: auto;
            }

            .card-left-1,
            .card-left-2,
            .card-left-3 {
                grid-column: 1 / 2;
            }
        }
    </style>

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

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: bold;
            font-size: 1.25rem;
        }

        /* Mengatur modal untuk berada di depan elemen lain */
        .modal {
            margin-top: 50px;
        }

        .modal-backdrop {
            z-index: -1;
            /* Nilai backdrop modal */
        }

        .button-container {
            position: relative;
            display: inline-block;
        }

        .hover-text {
            position: absolute;
            bottom: 75%;
            /* Posisi di atas tombol */
            background-color: #8b4513;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .button-container:hover .hover-text {
            opacity: 1;
            visibility: visible;
        }

        .button {
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>

    <h2>Dashboard</h2>
    <div class="container">
        <div class="accordion" id="accordionExample" style="display : none">
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

        <div class="card-grid">
            <!-- Kiri: Kotak 1 -->
            <div class="card card-left-1 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Profil Kamu</h5>
                    <div class=" d-flex align-items-center">
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


            <div class="card card-right shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">🏆 Leaderboard</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Badge</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboard as $index => $user)
                                    @php
                                        $badges = $user->badges ? explode(',', $user->badges) : [];
                                        $isCurrentUser = $user->email === auth()->user()->email;
                                    @endphp
                                    <tr class="{{ $isCurrentUser ? 'table-warning fw-bold' : '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                        <td>
                                            @forelse ($badges as $badge)
                                                <img src="{{ asset($badge) }}" alt="badge" width="40" height="40"
                                                    class="rounded-circle me-1">
                                            @empty
                                                <span class="text-muted">-</span>
                                            @endforelse
                                        </td>
                                        <td>{{ $user->poin }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card 4: Perolehan poin -->
            <div class="card card-left-2 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Perolehan Poin</h5>
                    {{-- @dd($perolehanNilai->poin) --}}
                    <h4 class="fw-semibold text-primary">{{ $perolehanNilai->nilai_poin ?? 0 }}</h4>
                    {{-- <h4 class="fw-semibold text-primary">{{ $totalPoints }}</h4> --}}
                </div>
            </div>

            <!-- Card 2: Profil -->
            <div class="card card-left-3 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Badge</h5>
                    <p class="card-text">Perolehan Badge ({{ $claimedBadges->count() }}/5)</p>
                    <!-- Display claimed badges -->
                    <div class="row">
                        @foreach ($claimedBadges as $badge)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($badge->link_gambar) }}" alt="{{ $badge->deskripsi }}" class="img-fluid"
                                    style="max-width: 100px;">
                                <p class="text-center">{{ $badge->nama }}</p>
                            </div>
                        @endforeach
                        @if ($claimedBadges->isEmpty())
                            <div class="col-12">
                                <p class="text-center">Belum ada badge yang diklaim.</p>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#badgeModal">
                        Cek Badge
                    </button>
                </div>
            </div>

            {{-- Badge Modal --}}
            <div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="badgeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="badgeModalLabel">Perolehan Badge</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Badges with Claim Buttons -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('img/high_rank.png') }}" alt="Master Badge" width="100px">
                                </div>
                                <div class="col-md-6 d-flex align-items-center button-container">
                                    <form action="{{ route('awardHighRankBadge') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success button" id="claimButton" {{ ($highRankBadgeClaimed ?? false) || !($eligibleForHighRankBadge ?? false) ? 'disabled' : '' }}>
                                            Klaim Badge
                                        </button>
                                        <div class="hover-text">Rebut posisi 3 besar untuk mendapatkan</div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('img/pembelajar_cepat.png') }}" alt="Fast Learner Badge"
                                        width="100px">
                                </div>
                                <div class="col-md-6 d-flex align-items-center button-container">
                                    <form action="{{ route('awardSiCepatBadge') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success button" id="claimButton" {{ $siCepatBadgeClaimed || !$eligibleForCepat ? 'disabled' : '' }}>
                                            Klaim Badge
                                        </button>
                                        <div class="hover-text">Selesaikan test dibawah 15 menit</div>
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('img/masterkesejarahan.png') }}" alt="Master Badge" width="100px">
                                </div>
                                <div class="col-md-6 d-flex align-items-center button-container">
                                    <form action="{{ route('awardHistoricalBadge') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" id="claimButton" {{ $badgeKesejarahanClaimed || !$eligibleForBadgeKesejarahan ? 'disabled' : '' }}>
                                            Klaim Badge
                                        </button>
                                        <div class="hover-text">Selesaikan Bab Kesejarahan</div>
                                    </form>
                                </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('img/masterkewirausahaan.png') }}" alt="Master of Material Badge"
                                        width="100px">
                                </div>
                                <div class="col-md-6 d-flex align-items-center button-container">
                                    <form action="{{ route('awardEntrepreneurialBadge') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" id="claimButton" {{ $badgeKwuClaimed || !$eligibleForBadgeKWU ? 'disabled' : '' }}>
                                            Klaim Badge
                                        </button>
                                        <div class="hover-text">Selesaikan Bab KWU</div>
                                    </form>
                                </div>
                            </div> -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('img/masterhistorio.png') }}" alt="Master of Material Badge"
                                        width="100px">
                                </div>
                                <div class="col-md-6 d-flex align-items-center button-container">
                                    <form action="{{ route('awardCombinedBadge') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" id="claimButton" {{ $badgeTamatClaimed || !$eligibleForTamat ? 'disabled' : '' }}>
                                            Klaim Badge
                                        </button>
                                        <div class="hover-text">Selesaikan Semua Bab</div>
                                    </form>
                                </div>
                            </div>
                        </div>
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