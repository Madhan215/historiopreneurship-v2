<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historio</title>
    {{-- Bootstap Lokal --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    {{-- Bootsrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/c263d98dea.js" crossorigin="anonymous"></script>
    <style>
        body {
            overflow: hidden;
            overflow-y: scroll;
        }

        #leftCol {
            position: fixed;
            overflow-y: scroll;
            overflow: hidden;
            top: 0;
            bottom: 0;
        }

        .dafus {
            text-indent: -35px;
            padding-left: 36px;
        }

        /* Style untuk radio */
        .icon-radio {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-radio input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
        }

        .icon-radio input[type="radio"]:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .icon-radio i {
            font-size: 40px;
            color: #FFB200;
            /* Ubah ukuran icon sesuai kebutuhan */
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper ">
        {{-- Navbar --}}

        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" id="navbarHead">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list"></i></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto ">
                <li>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Selamat datang, {{ auth()->user()->nama_lengkap }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li>
                                        <form action="{{route('login.logout')}}" method="get">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
    </div>
    </li>
    </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed" id="leftCol">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            {{-- <img src="#" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">Historiopreneurship</span>
        </a>
    <div class="sidebar ">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
            

            {{-- Halaman Guru --}}
            
            @if (auth()->user()->peran == 'guru')
            <li class="nav-header">MENU</li>
            <li class="nav-item">
                <a class="nav-link" href="/dataKelas">
                    <i class="bi bi-speedometer"></i>
                   <p>Data Kelas</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dataMahasiswa') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Data Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dataNilai') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Data Nilai</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dataLatihan') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Data Latihan</p>
                </a>
            </li>
                
            @endif
            @can('admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('evaluasi') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Evaluasi</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('info') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>info sebelum mulai</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dragndrop') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Latihan</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('evaluasi') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Evaluasi</p>
                </a>
            </li>
            <li class="nav-item">
                
                <a class="nav-link" href="{{ route('dashboard.showUser') }}">
                    <i class="bi bi-speedometer"></i>
                   <p>Dashboard Admin</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pages.materi') }}" >
                    <i class="bi bi-speedometer"></i>
                   <p>Materi</p>
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ session('active_menu') == 'dashboard' ? 'active' : '' }} " href="{{ route('dashboard.index') }}" >
                    <i class="bi bi-speedometer"></i>
                   <p>Dashboard</p>
                </a>
            </li>


            <li class="nav-header">MATERI</li>

            
            
            {{-- A. INFORMASI UMUM --}}
            <li class="nav-item {{ session('active_menu') == 'pages.A' ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ route('pages.A') }}" class="nav-link bab {{ session('active_menu') == 'pages.A' ? 'active' : '' }}" onclick="setSidebarStatus('CPL', 'pages.A')">
                    <i class="bi bi-info-circle"></i>
                    <p>Informasi Umum</p><i class="right bi bi-chevron-left"></i>
                  </a>
              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-CPL" class="nav-link sub {{ session('active_menu_sub') == 'CPL' ? 'active' : '' }}" name='CPL' onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>CPL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-CPMK" class="nav-link sub {{ session('active_menu_sub') == 'CPMK' ? 'active' : '' }}" name="CPMK" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>CPMK</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-Peran-Dosen" class="nav-link sub {{ session('active_menu_sub') == 'peran-dosen' ? 'active' : '' }}" name="peran-dosen" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Peran Dosen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-Sarana-dan-Prasarana" class="nav-link sub {{ session('active_menu_sub') == 'sarana-dan-prasarana' ? 'active' : '' }}" name="sarana-dan-prasarana" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Sarana dan Prasana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-Kolaborasi-Narasumber" class="nav-link sub {{ session('active_menu_sub') == 'kolaborasi-narasumber' ? 'active' : '' }}" name="kolaborasi-narasumber" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Kolaborasi Narasumber</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-Cara-Penggunaan" class="nav-link sub {{ session('active_menu_sub') == 'cara-penggunaan' ? 'active' : '' }}" name="cara-penggunaan" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Cara Penggunaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.A') }}#Halaman-Tahapan" class="nav-link sub {{ session('active_menu_sub') == 'tahapan' ? 'active' : '' }}" name="tahapan" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Tahapan</p>
                    </a>
                </li>
              </ul>
            </li>

            {{-- B.KESEJARAHAN --}}
            <li class="nav-item  {{ session('active_menu') == 'pages.B' ? 'menu-is-opening menu-open' : '' }}">
              <a href="{{ route('pages.B') }}" class="nav-link bab {{ session('active_menu') == 'pages.B' ? 'active' : '' }}" onclick="setSidebarStatus('kegiatan-pembelajaran-1', 'pages.B')">
                <i class="bi bi-1-square-fill"></i>
                <p>Kesejarahan</p><i class="right bi bi-chevron-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Kegiatan-Pembelajaran-1" class="nav-link sub {{ session('active_menu_sub') == 'kegiatan-pembelajaran-1' ? 'active' : '' }}" name="kegiatan-pembelajaran-1" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Kegiatan Pembelajaran 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Kegiatan-Pembelajaran-2" class="nav-link sub {{ session('active_menu_sub') == 'kegiatan-pembelajaran-2' ? 'active' : '' }}" name="kegiatan-pembelajaran-2" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Kegiatan Pembelajaran 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Lembar-Analisa-Kelompok" class="nav-link sub {{ session('active_menu_sub') == 'lembar-analisa-kelompok' ? 'active' : '' }}" name="lembar-analisa-kelompok" onclick="setSidebarStatusSub(this)">
                            <i class="bi bi-dot"></i>
                            <p class="text-left">Analisis Kelompok</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Lembar-Analisa-Individu" class="nav-link sub {{ session('active_menu_sub') == 'lembar-analisa-individu' ? 'active' : '' }}" name="lembar-analisa-individu" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Analisis Individu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Kegiatan-Pembelajaran-3" class="nav-link sub {{ session('active_menu_sub') == 'kegiatan-pembelajaran-3' ? 'active' : '' }}" name="kegiatan-pembelajaran-3" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Kegiatan Pembelajaran 3</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.B') }}#Halaman-Refleksi" class="nav-link sub {{ session('active_menu_sub') == 'refleksi' ? 'active' : '' }}" name="refleksi" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Refleksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dragndrop') }}" class="nav-link">
                        <i class="bi bi-dot"></i>
                        <p>
                          Latihan
                        </p>
                      </a> 
                </li>
              </ul>
            </li>

            {{-- C. KWU & KEWIRAUSAHAAN --}}
            <li class="nav-item  {{ session('active_menu') == 'pages.C' ? 'menu-is-opening menu-open' : '' }}">
              <a href="{{ route('pages.C') }}" class="nav-link bab {{ session('active_menu') == 'pages.C' ? 'active' : '' }}" onclick="setSidebarStatus('kewirausahaan-dan-kepariwisataan', 'pages.C')">
                <i class="bi bi-2-square-fill"></i>
                <p class="text-start">KWU & Kepariwisataan</p><i class="right bi bi-chevron-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Halaman-Kewirausahaan-dan-kepariwisataan" class="nav-link sub {{ session('active_menu_sub') == 'kewirausahaan-dan-kepariwisataan' ? 'active' : '' }}" name="kewirausahaan-dan-kepariwisataan" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>KWU & Kepariwisataan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Halaman-Lembar-Analisa-Kelompok-1" class="nav-link sub {{ session('active_menu_sub') == 'lembar-analisa-kelompok-1' ? 'active' : '' }}" name="lembar-analisa-kelompok-1" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Analisa Kelompok 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Lembar-Analisa-Kelompok-2" class="nav-link sub {{ session('active_menu_sub') == 'lembar-analisa-kelompok-2' ? 'active' : '' }}" name="lembar-analisa-kelompok-2" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Analisa Kelompok 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Lembar-Diskusi-Kelompok" class="nav-link sub {{ session('active_menu_sub') == 'lembar-diskusi-kelompok' ? 'active' : '' }}" name="lembar-diskusi-kelompok" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Diskusi Kelompok</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Lembar-Proyek-Individu" class="nav-link sub {{ session('active_menu_sub') == 'lembar-proyek-individu' ? 'active' : '' }}" name="lembar-proyek-individu" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Proyek Individu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Refleksi-1" class="nav-link sub {{ session('active_menu_sub') == 'refleksi-1' ? 'active' : '' }}" name="refleksi-1" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Refleksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Refleksi-2" class="nav-link sub {{ session('active_menu_sub') == 'praktik-lapangan-1' ? 'active' : '' }}" name="praktik-lapangan-1" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Praktik Lapangan 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Praktik-Lapangan-2" class="nav-link sub {{ session('active_menu_sub') == 'praktik-lapangan-2' ? 'active' : '' }}" name="praktik-lapangan-2" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Praktik Lapangan 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.C') }}#Refleksi-2" class="nav-link sub {{ session('active_menu_sub') == 'refleksi-2' ? 'active' : '' }}" name="refleksi-2" onclick="setSidebarStatusSub(this)">
                        <i class="bi bi-dot"></i>
                        <p>Refleksi</p>
                    </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item">
                {{-- Admin tidak melihat ini --}}
                @if (auth()->user()->peran != 'admin')
                   <a href="{{ route('info') }}" class="nav-link">
                <i class="bi bi-layout-text-window-reverse"></i>
                <p>
                  Evaluasi
                </p>
              </a> 
                @endif
              
            </li>
            <li class="nav-item mb-5">
                {{-- Admin tidak melihat ini --}}
                @if (auth()->user()->peran != 'admin')
                   <a href="{{route('pages.dafus')}}" class="nav-link">
                <i class="bi bi-layout-text-window-reverse"></i>
                <p>
                  Daftar Pustaka
                </p>
              </a> 
                @endif
              
            </li>
            </li>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </aside>
    <div class="content-wrapper" id="content-wrapper">
        <section class="container mt-3">
            <div class="row">
                <div class="col text-center mt-5">
                    <h1>HISTORIOPRENEURSHIP</h1>
                </div>
            </div>
            <div class="container">
                @yield('container')
            </div>
        </section>
    </div>

    <!-- Form tersembunyi untuk mengirim permintaan POST BAB-->
    <form id="sidebarStatusForm" action="{{ route('laman') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="menuBabSub" id="sidebarStatusInput">
        <input type="hidden" name="menu" id="menuInput">
    </form>

    <!-- Form tersembunyi untuk mengirim permintaan POST SUB-->
    <form id="sidebarStatusFormSub" action="{{ route('lamanSub') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="menuSub" id="menuInputSub">
    </form>



    </div>
    {{-- BAB --}}
    <script>
        function setSidebarStatus(status, menu) {
            // Set nilai input tersembunyi
            document.getElementById('sidebarStatusInput').value = status;
            document.getElementById('menuInput').value = menu;

            // Submit form tersembunyi
            document.getElementById('sidebarStatusForm').submit();
        }
    </script>

    {{-- SUB --}}
    <script>
        function setSidebarStatusSub(element) {
            // Set nilai input tersembunyi
            document.getElementById('menuInputSub').value = element.name;

            // Submit form tersembunyi
            document.getElementById('sidebarStatusFormSub').submit();
        }
    </script>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    <script> 
        // Ambil bab dan sub
        const $bab = document.getElementsByClassName('bab');
        // const $get_sub = document.getElementsByClassName('sub');
        const $get_sub = document.querySelectorAll('.sub');
        // console.log('Bab', $bab);
        // console.log('GetSub', $get_sub)

        for(let j=0; j < $bab.length; j++){
            // const $per_bab = $bab[j].querySelector('a.nav-link.bab p');
            // console.log($per_bab)
            // $bab[j].classList.add('active')

        }

        for(let i=0; i < $get_sub.length; i++){
            // const $nodes = $get_sub[i].querySelector('a.nav-link.sub p').innerHTML;
            // console.log($nodes);
            // $get_sub[i].classList.add('active')
        }

        $get_sub.forEach(link => {
            link.addEventListener('click', function() {
                // Remove the 'active' class from all nav links
                $get_sub.forEach(nav => nav.classList.remove('active'));

                // Add the 'active' class to the clicked nav link
                this.classList.add('active');
            });
        });

        // Nav Link Navigate
        const nav_link = document.querySelectorAll('.nav-link.sub');
        console.log(nav_link)

        function cekking(event){
            console.log('Event', event);
            console.log('Target', event.currentTarget);
            console.log('Tombol di tekan', event.currentTarget.name);
            hide_semua_sub();
            // document.getElementById(event.currentTarget.name).style.display = 'block'
        }
        

        nav_link.forEach(nav_link => {
            nav_link.addEventListener('click', cekking)
        })

        // Membuat sidebar tetap tampil
        
            
        

    </script>

</body>

</html>