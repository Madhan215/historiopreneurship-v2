@extends('layouts.home')
<style>
    body {
        background-color: var(--accent);
        scroll-behavior: smooth;
    }

    section {
        display: flex;
        align-items: center;
        position: relative;
        z-index: 1;
        scroll-snap-align: start;
    }

    .fixed-section {
        position: sticky;
        top: 0;
    }

    .feature-card,
    .gamification-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .feature-card:hover,
    .gamification-card:hover {
        transform: translateY(-5px);
    }

    footer {
        background-color: var(--primary);
        color: white;
        padding: 3rem 0;
    }

    footer a {
        color: #f5deb3;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        animation: bounce 1.8s infinite;
    }

    .scroll-link {
        color: var(--primary);
        font-size: 2.5rem;
        text-decoration: none;
    }

    .scroll-link:hover {
        color: var(--secondary);
    }

    /* Animasi panah naik-turun */
    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        40% {
            transform: translateX(-50%) translateY(10px);
        }

        60% {
            transform: translateX(-50%) translateY(5px);
        }
    }
</style>
@section('container')

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- ========== 1️⃣ SECTION: WELCOME ========== -->
    <section id="welcome" data-aos="fade-up">
        <div class="container">
            <div class="d-md-flex flex-md-row-reverse text-center text-md-start align-items-center justify-content-between">
                <img src="{{ asset('img/histoprener.gif') }}" alt="Landing Page Illustration" width="500" height="500"
                    decoding="async" class="img-fluid p-3">
                <div class="d-flex flex-column gap-3">
                    <div>
                        <h2 class="fw-semibold text-primary">SELAMAT DATANG DI</h2>
                        <h3 class="fw-bold" style="color: var(--secondary);">MEDIA PEMBELAJARAN INTERAKTIF
                            HISTORIOPRENEURSHIP</h3>
                    </div>
                    <p class="text-muted lead">"Menggabungkan Sejarah dan Kewirausahaan dalam Pengalaman Belajar yang
                        Seru dan Interaktif"</p>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        @if (Auth::check())
                            @if (auth()->user()->peran == 'siswa')
                                <a role="button" class="btn btn-primary btn-lg" href="/dashboard">MULAI BELAJAR</a>
                            @elseif(auth()->user()->peran == 'guru')
                                <a role="button" class="btn btn-outline-primary btn-lg" href="/guru/dashboard">HALAMAN
                                    GURU</a>
                            @else
                                <a role="button" class="btn btn-outline-primary btn-lg" href="/admin/dashboard">HALAMAN
                                    ADMIN</a>
                            @endif
                        @else
                            <a role="button" class="btn btn-primary btn-lg" href="/masuk">MULAI BELAJAR</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- 👇 Chevron Scroll Indicator -->
        <div class="scroll-down text-center">
            <a href="#fitur" class="scroll-link">
                <i class="bi bi-chevron-down"></i>
            </a>
        </div>
    </section>



    <!-- ========== 2️⃣ SECTION: FITUR UTAMA ========== -->
    <section id="fitur" class="bg-accent py-5" data-aos="fade-up">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">FITUR UTAMA</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card" data-aos="zoom-in">
                        <h4 class="fw-semibold text-secondary">📚 Sistem Kelas</h4>
                        <p class="mt-3 text-muted">Mendukung pengelolaan pembelajaran dengan kelas yang terstruktur
                            antara guru dan siswa.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
                        <h4 class="fw-semibold text-secondary">⚙️ Pengaturan Konten Dinamis</h4>
                        <p class="mt-3 text-muted">Guru dapat menambahkan dan memperbarui materi pembelajaran dengan
                            mudah sesuai kebutuhan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="400">
                        <h4 class="fw-semibold text-secondary">📈 Monitoring Progress</h4>
                        <p class="mt-3 text-muted">Pantau perkembangan belajar siswa melalui grafik dan laporan
                            interaktif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 3️⃣ SECTION: GAMIFIKASI ========== -->
    <section id="gamifikasi" class="py-5 bg-white" data-aos="fade-up">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">ELEMEN GAMIFIKASI</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="gamification-card" data-aos="flip-left">
                        <h4 class="fw-semibold text-primary">⭐ Poin</h4>
                        <p class="mt-3 text-muted">Kumpulkan poin dari setiap aktivitas pembelajaran dan naikkan
                            levelmu!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gamification-card" data-aos="flip-left" data-aos-delay="200">
                        <h4 class="fw-semibold text-primary">🏆 Papan Peringkat</h4>
                        <p class="mt-3 text-muted">Bersaing secara sehat dengan teman-temanmu di leaderboard pembelajar
                            terbaik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gamification-card" data-aos="flip-left" data-aos-delay="400">
                        <h4 class="fw-semibold text-primary">🎖️ Lencana</h4>
                        <p class="mt-3 text-muted">Dapatkan lencana prestasi untuk setiap pencapaian yang kamu raih.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 4️⃣ SECTION: KONTAK & LOKASI ========== -->
    <footer id="kontak" class="bg-primary rounded shadow" data-aos="fade-up">
        <div class="container">
            <div class="row g-4">
                <!-- Kolom 1 -->
                <div class="col-md-6 px-4">
                    <h3 class="fw-bold">Historiopreneurship</h3>
                    <p class="mb-1">Jurusan Pendidikan Ekonomi</p>
                    <p class="mb-1">Fakultas Keguruan dan Ilmu Pendidikan</p>
                    <p class="mb-3">Universitas Lambung Mangkurat</p>
                    <p>
                        <a href="https://www.instagram.com/historiopenko" target="_blank">
                            @historiopenko
                        </a>
                    </p>
                </div>

                <!-- Kolom 2 -->
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps?q=Jurusan+Pendidikan+Ekonomi+ULM&output=embed" width="100%"
                        height="250" style="border:0; border-radius:1rem;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

@endsection
