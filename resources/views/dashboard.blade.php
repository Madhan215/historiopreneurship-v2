@extends('layouts.main')

@section('container-content')


    <head>
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
    </head>

    <body>
        <h2 class="mb-3">Dashboard</h2>

        <div class="row text-center">
            @if (auth()->user()->peran == 'siswa' && auth()->user()->peran == 'guru')
                <!-- Profil -->
                <div class="col-md-6 mb-4">
                    <div class="card p-4">
                        <div class="card-body text-start">
                            <h5 class="card-title">Profil</h5>
                            <p class="card-text mt-5">Nama : {{ auth()->user()->nama_lengkap }}</p>
                            <p class="card-text">Kelas : {{ auth()->user()->kelas }}</p>
                            <p class="card-text">No HP : {{ auth()->user()->no_hp }}</p>
                            <p class="card-text">Email : {{ auth()->user()->email }}</p>
                            <p class="card-text">Alamat : {{ auth()->user()->alamat }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->peran == 'admin')
                <!-- Statistik Jumlah Pengguna -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary shadow rounded-3 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-person-badge-fill display-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-white">Jumlah Guru</h6>
                                    <h3 class="mb-0">{{ $jumlahGuru }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success shadow rounded-3 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-people-fill display-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-white">Jumlah Siswa</h6>
                                    <h3 class="mb-0">{{ $jumlahSiswa }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-dark shadow rounded-3 h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-bar-chart-fill display-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-white">Total Pengguna</h6>
                                    <h3 class="mb-0">{{ $jumlahGuru + $jumlahSiswa }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endif
            @if (auth()->user()->peran == 'siswa')
                <!-- Badge -->
                <div class="col-md-6 mb-4">

                    <div class="card p-4">
                        <div class="card-body">
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
                </div>
                <!-- Badge Modal -->

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
                                            <button type="submit" class="btn btn-success button" id="claimButton" {{ $highRankBadgeClaimed || !$eligibleForHighRankBadge ? 'disabled' : '' }}>
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
                                            <button type="submit" class="btn btn-success button" id="claimButton"
                                                {{$siCepatBadgeClaimed || !$eligibleForCepat ? 'disabled' : '' }}>
                                                Klaim Badge
                                            </button>
                                            <div class="hover-text">Selesaikan test dibawah 15 menit</div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <img src="{{ asset('img/masterkesejarahan.png') }}" alt="Master Badge" width="100px">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center button-container">
                                        <form action="{{ route('awardHistoricalBadge') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success" id="claimButton"
                                                {{$badgeKesejarahanClaimed || !$eligibleForBadgeKesejarahan ? 'disabled' : '' }}>Klaim Badge</button>
                                            <div class="hover-text">Selesaikan Bab Kesejarahan</div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <img src="{{ asset('img/masterkewirausahaan.png') }}" alt="Master of Material Badge"
                                            width="100px">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center button-container">
                                        <form action="{{ route('awardEntrepreneurialBadge') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success" id="claimButton" {{$badgeKwuClaimed || !$eligibleForBadgeKWU ? 'disabled' : ''  }}>
                                                Klaim Badge
                                            </button>
                                            <div class="hover-text">Selesaikan Bab KWU</div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <img src="{{ asset('img/masterhistorio.png') }}" alt="Master of Material Badge"
                                            width="100px">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center button-container">
                                        <form action="{{ route('awardCombinedBadge') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success" id="claimButton" {{$badgeTamatClaimed || !$eligibleForTamat ? 'disabled' : ''  }}>Klaim Badge</button>
                                            <div class="hover-text">Selesaikan Semua Bab</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Poin -->
                <div class="col-md-6 mb-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="card-title">Poin Kamu</h5>
                            <p class="card-text display-6">{{ $perolehanNilai->poin ?? 0 }}</p>
                        </div>
                        {{-- <div class="card-body">
                            <h5 class="card-title">Progress</h5>
                            <h6 class="text-start mt-3">1. Kesejarahan</h6>
                            <div class="progress rounded" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                    style="width:{{$materi_b * 20}}%" id="status_bar"></div>
                            </div>

                            <h6 class="text-start mt-3">2. KWU & Kepariwisataan</h6>
                            <div class="progress rounded" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                    style="width:{{$materi_c * 12.5}}%" id="status_bar"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            @endif
            @if (auth()->user()->peran == 'siswa' && auth()->user()->peran == 'guru')
                <!-- Leaderboard -->
                <div class="col-md-6 mb-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Leaderboard</h5>
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Poin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($leaderboard as $user)
                                        <tr>
                                            <th scope="row">{{ $n }}</th>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->poin }}</td>
                                        </tr>
                                        @php
                                            $n++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </body>



@endsection