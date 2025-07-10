@extends('layouts.home')

@section('container')
<head>
    <style>
        .card {
            height: 100%;
            /* Set height statis untuk card */
        }

        .primary-gsholar {
            background-color: #007bff;
            color: white;
        }

        .primary-gsholar:hover {
            background-color: #005bbc;
            color: white;
        }

        .card-body {
            flex-direction: column;
            justify-content: space-between;
            /* Memastikan konten terdistribusi merata */
        }

        .btn-group>.btn {
            font-size: small;
        }

        .card-img-top{
            transition: transform 0.5s ease;
        }

        .card-img-top:hover{
            transform: scale(1.1);
            cursor: pointer;
        }
    </style>
</head>
<h1>Perihal</h1>
<div class="mt-4 row">
    <div class="mb-5 col-lg-12">
        <div class="card">
            <div class="p-4 d-flex align-items-center card-header">
                <div class="mb-0 h5 fw-semibold card-title">
                    <i class="bi bi-info-circle"></i> INFORMASI MEDIA
                </div>
            </div>
            <div class="p-4 card-body">
                <p class="mb-4 card-text text-center ">Media pembelajaran ini dibuat dalam rangka penelitian kolaboratif pada tema Lahan Basah dengan judul:</p>
                <p class="fw-semibold fs-3 text-center card-text">MEDIA PEMBELAJARAN INTERAKTIF BERBASIS WEB PADA MATA KULIAH HISTORIOPRENEURSHIP DENGAN PENDEKATAN GAMIFIKASI</p>
                <p class="fw-semibold fs-5 text-center card-text">FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN</p>
                <p class="fw-semibold fs-5 text-center card-text">UNIVERSITAS LAMBUNG MANGKURAT</p>
                <p class="fs-6 text-center card-text">Kontak: <a href="mailto:dwiatmono@ulm.ac.id">dwiatmono@ulm.ac.id</a></p>
            </div>
        </div>
    </div>
    <div class="mb-5 col-lg-12">
        <div class="card">
            <div class="p-4 d-flex align-items-center card-header">
                <div class="mb-0 h5 fw-semibold card-title">
                    <i class="bi bi-people"></i> KOLABORATOR
                </div>
            </div>
            <div class="p-4 card-body">
                <div class="row">
                    <!-- Card 1 : DWI-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/dwi.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Prof. Dr, Dwi Atmono., M.Pd., M.Si.</h5>
                                <h6 class="">Ketua Peneliti</h6>
                                <p class="">Program Studi Pendidikan Ekonomi</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar"
                                        href="https://scholar.google.co.id/citations?user=0_PpL-4AAAAJ&hl=id"
                                        target="_blank">G.Scholar</a>
                                    <a type="button" class="btn btn-success"
                                        href="https://sinta.kemdikbud.go.id/authors/profile/6042714" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning"
                                        href="https://www.scopus.com/authid/detail.uri?authorId=57193211690&origin=resultslist"
                                        target="_blank">Scopus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 : RAHMAT-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/rahmat.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Dr. Muhammad Rahmattullah, M.Pd.</h5>
                                <h6 class="">Anggota Peneliti</h6>
                                <p class="">Program Studi Pendidikan Ekonomi</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar"
                                        href="https://scholar.google.com/citations?user=VzGEbD8AAAAJ&hl=en"
                                        target="_blank">G.Scholar</a>
                                    <a type="button" class="btn btn-success"
                                        href="https://sinta.kemdikbud.go.id/authors/profile/6020858" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning"
                                        href="https://www.scopus.com/authid/detail.uri?authorId=57193210630&origin=resultslist"
                                        target="_blank">Scopus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 : ANANDA-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/ananda.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Dr. Ananda Setiawan, M.Pd.</h5>
                                <h6 class="">Anggota Peneliti</h6>
                                <p class="">Program Studi Pendidikan Ekonomi</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar"
                                        href="https://scholar.google.com/citations?user=B2fwuhEAAAAJ&hl=id"
                                        target="_blank">G.Scholar</a>
                                    <a type="button" class="btn btn-success"
                                        href="https://sinta.kemdikbud.go.id/authors/profile/6730780" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning"
                                        href="https://www.scopus.com/authid/detail.uri?authorId=57218902315&origin=resultslist"
                                        target="_blank">Scopus</a>
                                </div>
                                <!-- <div class="social-buttons">
                                    <a href="https://scholar.google.com" target="_blank" class="btn primary-gsholar btn-sm">G.
                                        Scholar</a>
                                    <a href="https://sinta.kemdikbud.go.id" target="_blank"
                                        class="btn btn-success btn-sm">SINTA</a>
                                    <a href="https://www.scopus.com" target="_blank" class="btn btn-info btn-sm">Scopus</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 : FEBY-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/feby.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Rizky Febriyani Putri, M.Pd.</h5>
                                <h6 class="">Anggota Peneliti</h6>
                                <p class="">Program Studi Pendidikan IPA</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar"
                                        href="https://scholar.google.com/citations?user=xiDpDlQAAAAJ&hl=id"
                                        target="_blank">G.Scholar</a>
                                    <a type="button" class="btn btn-success"
                                        href="https://sinta.kemdikbud.go.id/authors/profile/6699782" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning" href="#" target="_blank">Scopus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 : NOVAN-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/novan.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Novan Alkaf Bahraini Saputra, S.Kom., M.T.</h5>
                                <h6 class="">Anggota Peneliti</h6>
                                <p class="">Program Studi Pendidikan Komputer</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar"
                                        href="https://scholar.google.com/citations?user=sEOvgeoAAAAJ&hl=id&authuser=2"
                                        target="_blank">G.Scholar</a>
                                    <a type="button" class="btn btn-success"
                                        href="https://sinta.kemdikbud.go.id/authors/profile/6758494" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning"
                                        href="https://www.scopus.com/authid/detail.uri?authorId=57216964088&origin=resultslist"
                                        target="_blank">Scopus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 6 : MADHAN-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/ramadhan.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Muhammad Ramadhani</h5>
                                <h6 class="">Anggota Peneliti/Mahasiswa</h6>
                                <p class="">Program Studi Pendidikan Komputer</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar" href="#" target="_blank">G.Scholar</a>
                                    <!-- <a type="button" class="btn btn-success" href="#" target="_blank">SINTA</a>
                                    <a type="button" class="btn btn-warning" href="#" target="_blank">Scopus</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 7 : SALMAN-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/salman.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Muhammad Salman 'Anshari Rizky</h5>
                                <h6 class="">Anggota Peneliti/Mahasiswa</h6>
                                <p class="">Program Studi Pendidikan Komputer</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar" href="https://scholar.google.co.id/citations?hl=en&user=Dz18STEAAAAJ" target="_blank">G.Scholar</a>
                                    <!-- <a type="button" class="btn btn-success" href="#" target="_blank">SINTA</a> -->
                                    <!-- <a type="button" class="btn btn-warning" href="#" target="_blank">Scopus</a> -->
                                </div>
                                <!-- <div class="social-buttons">
                                    <a href="https://scholar.google.com" target="_blank" class="btn primary-gsholar btn-sm">G.
                                        Scholar</a>
                                    <a href="https://sinta.kemdikbud.go.id" target="_blank"
                                        class="btn btn-success btn-sm">SINTA</a>
                                    <a href="https://www.scopus.com" target="_blank" class="btn btn-info btn-sm">Scopus</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Card 8 : LENI-->
                    <div class="col-md-3 mb-4">
                        <div class="card text-center">
                            <img src="{{asset('img/kolaborator/leni.png')}}" alt="Researcher Photo" class="card-img-top rounded-circle mx-auto"
                                style="width: 150px; ">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Leni Susanti</h5>
                                <h6 class="">Anggota Peneliti/Mahasiswa</h6>
                                <p class="">Program Studi Pendidikan Ekonomi</p>
                                <div class="btn-group mt-auto" role="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn primary-gsholar" href="#" target="_blank">G.Scholar</a>
                                    <!-- <a type="button" class="btn btn-success" href="#" target="_blank">SINTA</a> -->
                                    <!-- <a type="button" class="btn btn-warning" href="#" target="_blank">Scopus</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 col-lg-12">
        <div class="card">
            <div class="p-4 d-flex align-items-center card-header">
                <div class="mb-0 h5 fw-semibold card-title">
                    <i class="bi bi-book"></i> DAFTAR PUSTAKA DAN ATRIBUSI
                </div>
            </div>
            <div class="p-4 card-body">
                <p class="dafus">
                    Adhitya, W., Bayu, K., & Morina, S. G. (2019). Dampak Sektor Pariwisata Terhadap Pertumbuhan Eknomi ( TLG Hipotesis, Studi Kasus : 8 Negara ASEAN). E-Jurnal Ekonomi dan Bisnis Universitas Udayana, 1193-1208.
                </p> 
                <p class="dafus">
                    Asisten Deputi Pengembangan Wisata Budaya Deputi Bidang Pengembangan Industri dan Kelembagaan Kementerian Pariwisata. (2019). Pedoman Pengembangan Wisata Sejarah dan Warisan Budaya. Jakarta Selatan: Gedung Film Pesona Indonesia. 
                </p>
                <p class="dafus">
                    Aziz, R. H. (2018). Perencanaan Wilayah dan Kota.
                </p>
                <p class="dafus">        
                    Damayanti, E. (2014). Strategi Capacity Building Pemerintah Desa dalam Pengembangan Potensi Ekowisata Berbasis Masyarakat Lokal (Studi di Kampoeng Ekowisata, Desa Bendosari, Kecamatan Pujon, Kabupaten Malang). Jurnal Administrasi Publik, 464-470. 
                <p class="dafus">
                    Fitra., & Maifa, S.  (2022). Adaptasi semangat merdeka belajar dengan penerapan model pembelajaran project based learning sebagai bentuk inovasi dalam pembelajaran. Journal of Pedagogy and Online Learning, 38-46. 
                </p>
                    Gibson, C. (2015). Negotiating Regional Creative Economic :Academics as Expert Intermediaries Advocating Progressive Alternative. Journal of Regional Studies, 476-479. 
                </p>
                <p class="dafus">
                    Huiwen, G., & Hassink, R. (2017). Exploring the clustering of creative industries. Journal of European Planning Studies, 583-600.
                </p>
                <p class="dafus">
                    Irdika, I. W. (2007). Pusaka Budaya dan Pariwisata . Pustaka Larasan.
                </p>
                <p class="dafus">
                    Irham, F. (2014). Kewirausahaan Toeri, Kasus dan Solusi. Bandung: Alfabeta. 
                </p>
                <p class="dafus">
                    Ishak, W. (2020). Pesona Objek Wisata Sejarah di Kabupaten Sinjai. Journal of tourism, Hospitality, Travel and Busines , 2656-1336.
                </p>
                <p class="dafus">
                    Ismayanti. (2010). Pengantar Pariwisata. Jakarta: Grasindo.
                </p>
                <p class="dafus">
                    Jamal, M., bustami, & Desma, R. (n.d.). Kebudayaan dan Wisata Sejarah : Exsistensi Obyek Sejarah Terhadap Perkembangan Wisata di Pariangan kabupaten Tanah Datar. Jurnal Sejarah dan Kebudayaan.
                </p>
                <p class="dafus">
                    Kirom, N. R., Sudarmiatin, & Putra, I. W. (2016). Faktor-faktor Penentu Daya Tarik Wisata Budaya dan Pengaruhnya Terhadap Kepuasan Wisatawan. Jurnal pendidikan, 536546.
                </p>
                <p class="dafus">
                    Kristo, & Yunita, S. (2020). Analisis Dampak Sektor Pariwisata terhadap Kesejahteraan Pedagang di Kota Banjarmasin. Jurnal Ilmu Ekonomi dan Pembangunan, 551-559. 
                </p>
                <p class="dafus">
                    Pradana, H. A. (2020). Pengembangan Pariwisata Pasar Terapung Kota Banjarmasin. Jurnal Kebijakan Pembangunan, 63-76.
                </p>
                <p class="dafus">
                    Rusdiana. (2014). Kewirausahaan Teori dan Praktik. Bandung: CV Pustaka Setia
                </p>
                <p class="dafus">
                    Sukamdani, S. G. (2013). Wirausaha Berbasis Islam & Kebudayaan. Jakarta: Pustaka Bisnis Indonesia.
                </p>
                <p class="dafus">
                    Suryana. (2014). Kewirausahaan Kiat dan Proses Menuju Sukses, Jakarta: Salemba Empat.
                </p>
                <p class="dafus">
                    Suwena, I. K., & Widyamatja, I. G. (2017). Pengetahuan Dasar Ilmu Pariwisata. Bali: Pustaka Larasan.
                </p>
                <p class="dafus">
                    Suyatmin, W. A., & Edy, P. S. (2017). Perkembangan Konsep dan Riset E-Busniess di Indonesia 744 Potensi Daya Tarik Wisata Sejarah Budaya. Seminar Nasional Riset Manajemen & Bisnis.
                </p>
                <p class="dafus"> 
                    Yakup, A. P. (2019). Pengaruh Sektor Pariwisata terhadap pertumbuhan Ekonomi Di Indonesia. Yoeti, Oka .A. 1996. Pengantar Ilmu Pariwisata. Bandung: Angkasa
                </p>
                <p class="dafus">
                    Yoeti, Oka .A. 1997. Perencanaan dan Pengembangan Pariwisata. Jakarta: Pradnya Paramita
                </p>
                <p class="dafus">
                    Yoeti, O. (2006). Pariwisata Budaya Masalah dan Solusinya. Jakarta: PT Pradnya Paramita.
                </p>
                <p class="dafus">
                    Ilustrasi yang digunakan pada media pembelajaran ini bersumber dari <a href="https://storyset.com/work" target="_blank">storyset.com/work</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection