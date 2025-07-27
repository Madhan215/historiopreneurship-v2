{{-- Untuk Template Materi --}}
@extends('layouts.home')

@section('container-base')

    {{-- <h1 id="progress_halaman">0</h1> --}}
    <!-- Google Translate -->
    <div id="google_translate_element" style="position: fixed; top: 10px; left: 10px; z-index: 9999;"></div>
    <div class="g-0 row">
        <div class="border-end border-top col-lg-3">
            <div class="bg-white sticky-top accordion">
                <h5 class="active text-primary text-center p-3 mb-0">MENU</h5>
                <div class="list-group list-group-flush">
                    @if ($userRole === 'siswa' || $userRole === 'guru')
                        <a href="/dashboard"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('dashboard') ? 'active' : '' }}">
                            <span><i class="bi bi-speedometer"></i> Dashboard</span></a>
                    @endif
                    @if (auth()->user()->peran == 'siswa')
                        <a href="/hasil"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('hasil') ? 'active' : '' }}">
                            <span><i class="bi bi-journal-check"></i> Hasil</span></a>
                    @endif
                    @if (auth()->user()->peran == 'guru')
                        <a href="/Data-Kelas"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('data-kelas') ? 'active' : '' }}">
                            <span><i class="bi bi-archive-fill"></i></i> Data Kelas</span></a>
                        <a href="/Data-Mahasiswa"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('data-mahasiswa') ? 'active' : '' }}">
                            <span><i class="bi bi-people-fill"></i> Data Mahasiswa</span></a>
                        <a href="/Progress-Belajar"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('progress-belajar') ? 'active' : '' }}">
                            <span><i class="bi bi-list-ol"></i> Progress Belajar</span></a>
                        <a href="/Data-Nilai"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('data-nilai') || Route::is('dataJawabanIndividu') ? 'active' : '' }}">
                            <span><i class="bi bi-journal-text"></i> Data Nilai</span></a>
                        <a href="/data-export-nilai"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('data-export-nilai') || Route::is('dataJawabanIndividu') ? 'active' : '' }}">
                            <span><i class="bi bi-download"></i> Export Nilai</span></a>
                    @endif
                    @if (auth()->user()->peran == 'admin')
                        <a href="{{ route('manajemen-konten.index') }}"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('manajemen-konten.*') ? 'active' : '' }}">
                            <span><i class="bi bi-folder2-open"></i> Manajemen Konten</span>
                        </a>
                        <a href="/admin/reset-password"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('admin.reset.password') ? 'active' : '' }}">
                            <span><i class="bi bi-key"></i> Reset Password</span>
                        </a>
                    @endif
                </div>
                <h5 class="active text-primary text-center p-3 mb-0">MATERI</h5>
                <div class="accordion vh-100 overflow-auto" id="sidebarAccordion">
                    <div class="accordion-item" id="menuHeading1">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button text-primary fw-bold {{ $activeMenu == 'menu1' ? '' : 'collapsed' }} text-dark"
                                type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse1"
                                aria-expanded="true" aria-controls="menuCollapse1">
                                <i class="bi bi-info-circle"></i>
                                &nbsp;
                                Informasi Umum
                            </button>
                        </h2>
                        <div id="menuCollapse1"
                            class="accordion-collapse collapse  {{ $activeMenu == 'menu1' ? 'show' : '' }}"
                            aria-labelledby="menuHeading1" data-bs-parent="#sidebarAccordion">
                            <div class="list-group list-group-flush">
                                <a href="/Informasi/CPL"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-1') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> CPL</span></a>
                                <a href="/Informasi/CPMK"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-2') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> CPMK</span></a>
                                <a href="/Informasi/Peran-Dosen"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-3') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Peran Dosen</span></a>
                                <a href="/Informasi/Sarana-Dan-Prasarana"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-4') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Sarana dan Prasarana</span></a>
                                <a href="/Informasi/Kolaborasi-Narasumber"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-5') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kolaborasi Narasumber</span></a>
                                <a href="/Informasi/Cara-Penggunaan"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-6') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Cara Penggunaan</span></a>
                                <a href="/Informasi/Tahapan"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('A-7') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Tahapan</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" id="menuHeading2">
                        <h2 class="accordion-header">

                            <button
                                class="accordion-button text-primary fw-bold {{ $activeMenu == 'menu2' ? '' : 'collapsed' }} text-dark"
                                type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse2"
                                aria-expanded="true" aria-controls="menuCollapse2">
                                {{-- <i class="bi bi-1-square"></i> --}}
                                <i class="bi bi-1-square"></i>
                                &nbsp;
                                Kesejarahan
                            </button>
                        </h2>
                        <div id="menuCollapse2"
                            class="accordion-collapse collapse {{ $activeMenu == 'menu2' ? 'show' : '' }}"
                            aria-labelledby="menuHeading2" data-bs-parent="#sidebarAccordion">
                            <div class="list-group list-group-flush">
                                <a href="/Kesejarahan/Pre-Test"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-1') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Pre-Test</span></a>
                                <a href="/Kesejarahan/Kegiatan-Pembelajaran-1"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-2') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kegiatan Pembelajaran 1</span></a>
                                <a href="/Kesejarahan/Kuis-Kesejarahan"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-3') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kuis Kesejarahan</span></a>
                                <a href="/Kesejarahan/Kegiatan-Pembelajaran-2"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-4') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kegiatan Pembelajaran 2</span></a>
                                <a href="/Kesejarahan/Analisis-Kelompok"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-5') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Analisis Individu 1</span></a>
                                <a href="/Kesejarahan/Analisi-Individu"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-6') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Analisis Individu 2</span></a>
                                <a href="/Kesejarahan/Kegiatan-Pembelajaran-3"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-7') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kegiatan Pembelajaran 3</span></a>
                                <a href="/Kesejarahan/Post-Test"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-8') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Post-Test</span></a>
                                <a href="/Kesejarahan/Refleksi"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('B-9') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Refleksi</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" id="menuHeading3">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button text-primary fw-bold {{ $activeMenu == 'menu3' ? '' : 'collapsed' }} text-dark"
                                type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse3"
                                aria-expanded="true" aria-controls="menuCollapse3">
                                <i class="bi bi-2-square"></i>
                                &nbsp;
                                KWU & Kepariwisataan
                            </button>
                        </h2>
                        <div id="menuCollapse3"
                            class="accordion-collapse collapse {{ $activeMenu == 'menu3' ? 'show' : '' }}"
                            aria-labelledby="menuHeading3" data-bs-parent="#sidebarAccordion">
                            <div class="list-group list-group-flush">
                                <a href="/KWU-dan-Kepariwisataan/Pre-Test"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-1') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Pre-Test</span></a>
                                <a href="/KWU-dan-Kepariwisataan/KWU-dan-Kepariwisataan"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-2') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> KWU & Kepariwisataan</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Kuis"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-3') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Kuis KWU & Kepariwisataan</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Analisis-Kelompok-1"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-4') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Analisa Kelompok 1</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Analisis-Kelompok-2"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-5') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Analisa Kelompok 2</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Diskusi-Kelompok"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-6') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Diskusi Kelompok</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Proyek-Individu"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-7') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Proyek Individu</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Refleksi-1"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-8') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Refleksi 1</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Praktik-Lapangan-1"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-9') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Praktik Lapangan 1</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Praktik-Lapangan-2"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-10') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Praktik Lapangan 2</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Post-Test"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-11') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Post-Test</span></a>
                                <a href="/KWU-dan-Kepariwisataan/Refleksi-2"
                                    class="py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('C-12') ? 'active' : '' }}">
                                    <span><i class="bi bi-dot"></i> Refleksi 2</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="/bahan-bacaan"
                            class="border rounded py-3 d-flex align-items-center justify-content-between small bg-primary-light text-primary-dark false list-group-item {{ Route::is('sumber') ? 'active' : '' }}">
                            <span class=""><i class="bi bi-book"></i> Bahan Bacaan</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white text-dark border-top col-lg-9">
            @php
                $routesToShowDiv = ['B-1', 'B-8', 'C-1', 'C-11'];
            @endphp

            {{-- Progress bar hanya akan tampil pada Pre Test dan Post Test --}}
            @if (Route::is($routesToShowDiv))
                <div class="p-3 bg-white border-bottom">
                    <div class="progress">
                        <div role="progressbar" class="progress-bar bg-primary progress-bar-striped fw-semibold"
                            aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="status_bar"></div>
                    </div>
                </div>
            @endif

            <div class="p-4 p-lg-5">
                @yield('container-content')
                {{-- Tombol Sebelumnya --}}
                @if (request()->routeIs('A-*') || request()->routeIs('B-*') || request()->routeIs('C-*'))
                    <div class="w-100 py-5 d-flex align-items-center justify-content-between bottom-0  ">
                        {{-- Tombol Sebelumnya --}}
                        @if ($prevUrl)
                            <a href="{{ $prevUrl }}"
                                class="d-flex align-items-center py-2 px-3 text-white btn btn-danger" id="prevButton">
                                <i class="bi bi-chevron-double-left"></i> Sebelumnya
                            </a>
                        @else
                            <span class="d-flex align-items-center py-2 px-3 text-white btn btn-danger disabled">
                                <i class="bi bi-chevron-double-left"></i> Sebelumnya
                            </span>
                        @endif

                        {{-- Tombol Selanjutnya --}}
                        @if ($nextUrl)
                            <a href="{{ $nextUrl }}"
                                class="d-flex align-items-center py-2 px-3 text-white btn btn-success" id="nextButton">
                                Selanjutnya <i class="bi bi-chevron-double-right"></i>
                            </a>
                        @else
                            <span class="d-flex align-items-center py-2 px-3 text-white btn btn-success disabled">
                                Selanjutnya <i class="bi bi-chevron-double-right"></i>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        // Ambil bab dan 
        const $bab = document.getElementsByClassName('bab');
        // const $get_ = document.getElementsByClassName('');
        const $get_ = document.querySelectorAll('.');
        // console.log('Bab', $bab);
        // console.log('Get', $get_)

        for (let j = 0; j < $bab.length; j++) {
            // const $per_bab = $bab[j].querySelector('a.nav-linkbab p');
            // console.log($per_bab)
            // $bab[j].classList.add('active')

        }

        for (let i = 0; i < $get_.length; i++) {
            // const $nodes = $get_[i].querySelector('a.nav-link p').innerHTML;
            // console.log($nodes);
            // $get_[i].classList.add('active')
        }

        $get_.forEach(link => {
            link.addEventListener('click', function() {
                // Remove the 'active' class from all nav links
                $get_.forEach(nav => nav.classList.remove('active'));

                // Add the 'active' class to the clicked nav link
                this.classList.add('active');
            });
        });

        // Nav Link Navigate
        const nav_link = document.querySelectorAll('.nav-link');
        console.log(nav_link)

        // Suara pada saat klik
        var click_sound = new Audio("{{ asset('sound/Click.mp3') }}")

        function cekking(event) {
            click_sound.play()
            console.log('Event', event);
            console.log('Target', event.currentTarget);
            console.log('Tombol di tekan', event.currentTarget.name);
            hide_semua_();
            document.getElementById(event.currentTarget.name).style.display = 'block';
        }


        nav_link.forEach(nav_link => {
            nav_link.addEventListener('click', cekking)
        })

        // Untuk mengaktifkan dan nonaktifkan  di sidebar
        function active_(info) {
            if ({{ isset($halaman_terbuka) }}) {
                console.log("Halaman Terbuka", {{ isset($halaman_terbuka) }})
            } else {
                click_sound.play()
            }

            if (info == 'nav') {
                click_sound.play()
            }

            // matikan_active();
            nav_link.forEach(element => {
                if (element.name == materi_a[$].id) {
                    console.log(element.name, materi_a[$].id);
                    console.log(element);
                    element.classList.add('active');
                    element.classList.remove('disabled');
                    element.classList.remove('text-gray');

                    // Mengubah lock menjadi dot
                    element.querySelector('i').classList.remove('bi-lock')
                    element.querySelector('i').classList.add('bi-dot')
                } else {
                    element.classList.remove('active');
                }
            });

        }

        active_()

        // Mempertahankan progress halaman
        // Index dimulai dari 0

        let $progress_a = {{ session('materi_a') ?? 0 }}
        let $progress_b = {{ session('materi_b') ?? 0 }}
        let $progress_c = {{ session('materi_c') ?? 0 }}

        function buka_($side, $bab) {
            console.log('MAU BUKA  YAAA', $side)
            if ($bab == "A") {
                for (let i = 0; i <= $progress_a; i++) {
                    console.log($progress_a)
                    $side[i].querySelector('a').classList.remove('disabled');
                    $side[i].querySelector('a').classList.remove('text-gray');

                    // Mengubah lock menjadi dot
                    $side[i].querySelector('i').classList.remove('bi-lock')
                    $side[i].querySelector('i').classList.add('bi-dot')
                }
            } else if ($bab == "B") {
                for (let i = 0; i <= $progress_b; i++) {
                    console.log($progress_b)
                    $side[i].querySelector('a').classList.remove('disabled');
                    $side[i].querySelector('a').classList.remove('text-gray');

                    // Mengubah lock menjadi dot
                    $side[i].querySelector('i').classList.remove('bi-lock')
                    $side[i].querySelector('i').classList.add('bi-dot')
                }
            } else if ($bab == "C") {
                for (let i = 0; i <= $progress_c; i++) {
                    console.log($progress_c)
                    $side[i].querySelector('a').classList.remove('disabled');
                    $side[i].querySelector('a').classList.remove('text-gray');

                    // Mengubah lock menjadi dot
                    $side[i].querySelector('i').classList.remove('bi-lock')
                    $side[i].querySelector('i').classList.add('bi-dot')
                }
            }
        }

        let $side_A = document.querySelectorAll('#side_A li')
        let $side_B = document.querySelectorAll('#side_B li')
        let $side_C = document.querySelectorAll('#side_C li')
        buka_($side_A, 'A')
        buka_($side_B, 'B')
        buka_($side_C, 'C')
    </script>

    {{-- Mengirim progress ke dalam database --}}
    <form id="updateHalaman" action="{{ url('updateAksesHalaman') }}" method="GET" hidden>
        @csrf
        {{-- <input type="hidden" name="user_id" value="{{ $user }}"> --}}
        <input type="hidden" name="halaman" value="materi_b">
        <input type="hidden" name="progress" id="halaman">
    </form>

    <script>
        var $progress = 0;
        var $sub = document.getElementById('progress_halaman').innerHTML;
        // Status Bar -> Perlu diatur B dan C nya
        let status_bar = document.getElementById('status_bar');

        function update_status() {
            let persen = $sub * 12.5;
            status_bar.style.width = `${persen}%`;
            status_bar.innerHTML = persen + "%";

        }
        update_status();

        // Testing
        // console.log(materi_a)
        let progressHalaman = document.getElementById('halaman');
        let updateHalaman = document.getElementById('updateHalaman');



        // document.getElementById('nextButton').addEventListener('click', function(event) {
        //     event.preventDefault();
        //     next(); // Panggil fungsi prev
        // });

        // document.getElementById('prevButton').addEventListener('click', function(event) {
        //     // event.preventDefault();
        //     prev(); // Panggil fungsi prev
        // });

        function next() {

            $sub++;
            console.log('Selanjutnya', $sub, $progress)
            if ($sub > $progress) {
                $progress++;
                progressHalaman.value = $progress;
                updateHalaman.submit()

            }

        }

        function prev() {
            console.log('Sebelumnya', $sub)
            $sub--;
        }
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,es,ko,ar,tl', // tambahkan sesuai kebutuhan
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

@endsection
