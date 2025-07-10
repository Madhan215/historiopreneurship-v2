@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<form action="{{route('simpanJawabanIndividuKewirausahaan')}}" method="POST">
    @csrf
    <h2>Proyek Individu</h2>
    <p class="text-lg">AKTIVITAS 4</p>
    <p class="text-sm">4 JP x @ 50 menit = 200 menit </p>

    <p class="mt-4">
        <b>MERANCANG PRODUK DAN JASA TERKAIT KEWIRAUSAHAAN KESEJARAHAN BERDASARKAN KONSEP
            KEWIRAUSAHAAN</b>
    </p>
    <p>
        Wirausahawan merupakan seorang individu yang memiliki semangat, kemampuan, dan pikiran untuk menaklukkan cara
        berpikir yang lambat dan malas. Seorang wirausahawan adalah seorang inovator yang memiliki naluri untuk melihat
        peluang yang ada. Seorang wirausahawan akan mencari kombinasi baru yang menggabungkan lima hal: barang dan jasa
        baru, teknik produksi baru, sumber bahan baku baru, pasar baru, dan organisasi industri baru. Sementara itu,
        orang-orang yang mampu melihat ke depan, berpikir rasional, dan menemukan solusi atas berbagai masalah akan
        menjadi seorang wirausahawan yang sukses (Ratumbusyang, 2017)
    </p>
    <p>
        Untuk menjadi wirausahawan yang sukses, mahasiswa harus mampu membuka peluang bisnis, tanggap terhadap orang
        lain dan menjalin hubungan antar wirausaha. Sebagai upaya menekan angka pengangguran, perlu diciptakan
        peluang-peluang usaha baru, salah satunya di bidang kewirausahaan kesejarahan.
    </p>
    <div class="border rounded bg-warning-subtle p-2">
        Pada aktivitas ini, kalian membuat business plan produk dan jasa terkait kewirausahaan kesejarahan. Kalian
        diminta untuk bekerja sambil belajar secara individu untuk membuat business plan tersebut. Kalian bebas
        menyusun, merancang dan mengatur proyek yang kalian kerjakan.
    </div>
    <p class="mt-4 text-center text-lg">
        <b>Hal yang akan kalian lakukan: </b>
    </p>
    <ol class="mt-3">
        <li>
            Pelajari buku ajar dengan seksama;
        </li>
        <li>
            Pada bagian penentuan proyek, kalian akan menentukan proyek yang sesuai dengan isi wacana;
        </li>
        <li>
            Pada bagian perancangan proyek, kalian menyusun Langkah-langkah untuk menyelesaikan proyek;
        </li>
        <li>
            Pada bagian penyusunan jadwal proyek, kalian harus Menyusun jadwal untuk memperkirakan awal pelaksanaan
            hingga selesai;
        </li>
        <li>
            Pada bagian penyelesaian proyek dan monitoring dosen, kalian mengisi form monitoring keterlaksanaan jadwal
            penyelesaian proyek yang sebelumnya telah disepakati;
        </li>
        <li>
            Pada bagian penyusunan dan presentasi proyek, kalian mempresentasikan proyek yang telah dibuat.
        </li>
        <li>
            Pada bagian evaluasi proses dan hasil proyek, kalian menjawab pertanyaan pada kolom yang telah disediakan
            mengenai proyek yang telah dikerjakan.
        </li>
    </ol>
    <p class="text-lg">LENGKAPILAH KOLOM DI BAWAH INI!</p>
    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="langkah-kerja-tab" data-bs-toggle="tab" data-bs-target="#langkah-kerja"
                type="button" role="tab" aria-controls="langkah-kerja" aria-selected="true">Langkah Kerja</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rancangan-proyek-tab" data-bs-toggle="tab" data-bs-target="#rancangan-proyek"
                type="button" role="tab" aria-controls="rancangan-proyek" aria-selected="false">Rancangan
                Proyek</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pengumpulan-laporan-tab" data-bs-toggle="tab"
                data-bs-target="#pengumpulan-laporan" type="button" role="tab" aria-controls="pengumpulan-laporan"
                aria-selected="false">Pengumpulan Laporan</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="myTabContent">
        <!-- Tab Fnalisis Individu -->
        <div class="tab-pane fade show active" id="langkah-kerja" role="tabpanel" aria-labelledby="langkah-kerja-tab">
            <p class="text-lg mt-2">
                <b>Belajar Karakter Berwirausaha</b>
            </p>

            <p><b>Persiapan</b></p>
            <ol>
                <li>
                    Mahasiswa menentukan topik berwirausaha yang berkarakter dan dampak dari COVID 19 di berbagai sektor
                    yang berhubungan dengan ekonomi.
                </li>
                <li>Mempersiapan tempat dan sound system oleh panitia.</li>
                <li>
                    Mempersiapkan 2 narasumber tokoh wirausahawan lokal untuk berbagi mengenai Wirausaha Yang
                    Bertanggung JawabPokok materi yang disampaikan adalah :
                    <ol type="a">
                        <li>
                            Pengalaman mulai berwiraswasta.
                        </li>
                        <li>
                            Alasan kenapa memilih bisnis tersebut.
                        </li>
                        <li>
                            Bagaimana permasalahan dan peluang yang timbul dari bisnis tersebut
                        </li>
                        <li>
                            Karakter Wirausahawan.
                        </li>
                        <li>
                            Dampak COVID 19 terhadap perekonomian
                        </li>
                        <li>
                            Motivasi peserta didik
                        </li>
                    </ol>
                </li>
            </ol>
            <p><b>Pelaksanaan</b></p>
            <ol>
                <li>
                    Mahasiswa membuat dokumen jurnal belajar.
                </li>
                <li>
                    Mahasiswa memfasilitasi sebagai Moderator dan Pewara Acara.
                </li>
                <li>
                    Peserta didik mendengarkan dan secara aktif didorong untuk aktif menggali informasi dari narasumber.
                </li>
                <li>
                    Peserta didik diberikan tugas dengan mencatat rangkuman informasi yang telah disampaikan narasumber
                    selama acara berlangsung.
                </li>
                <li>
                    Peserta didik diberikan tugas dengan mencatat rangkuman informasi yang telah disampaikan narasumber
                    selama acara berlangsung.
                </li>
            </ol>
            <p class="text-lg"><b>Orasi "Jika Aku Menjadi?"</b></p>
            <p><b>Deskripsi</b></p>
            <p>
                Seorang wirausahawan harus memiliki karakter yang visioner. Dalam menumbuhkan karakter tersebut, peserta
                didik diberikan kesempatannya untuk menyusun visi dan misinya ketika berkeinginan menjadi seorang
                pengusaha. Dengan diberikan tenggat waktu, peserta didik dituntut untuk menuangkan visi dan misinya
                secara spontan sehingga diharapkan peserta didik berani mengutarakan visi dan misinya serta memahami
                salah satu karakter wirausahawan.
            </p>
            <p><b>Persiapan</b></p>
            <ol>
                <li>
                    Peserta didik diminta mempersiapkan alat tulis dan secarik kertas.
                </li>
                <li>
                    Mahasiswa mempersiapkan pertanyaan yang harus dijawab oleh rekan lainnya:
                    <ol type="a">
                        <li>
                            Jika kamu memiliki modal dan menjadi seorang wirausahawan, kamu ingin menjadi pengusaha apa?
                        </li>
                        <li>
                            Kalau kamu sudah menentukan menjadi pengusaha apa, maka apa visi dan misimu menjadi seorang
                            pengusaha?
                        </li>
                    </ol>
                </li>

            </ol>
            <p><b>Pelaksanaan</b></p>
            <ol>
                <li>
                    Peserta didik diberikan pertanyaan yang telah disiapkan.
                </li>
                <li>
                    Peserta diminta menjawab pertanyaan tersebut di secarik kertas dengan tenggat waktu 15 menit.
                </li>
                <li>
                    Meminta audien maju ke depan berorasi tentang visi dan misinya ketika menjadi wirausahawan.
                </li>
                <li>
                    Memberikan refleksi singkat dan mengijikan teman-temannya untuk bertanya.
                </li>
                <li>
                    Peserta didik diajak untuk meneriakkan “Aku ingin menjadi Pengusaha ............. Aku pasti sukses!”
                    Secara bersamaan.
                </li>
            </ol>
            <p>
                Hasil karya dan Cara Berorasi di depan umum pada kegiatan ini bukan menjadi pokok pembelajaran, namun
                memperlihatkan kecepatan, dan kemandiriannya dalam menentukan visi dan misinya sendiri untuk menjadi
                seorang wirausahawan.
            </p>
        </div>

        <div class="tab-pane fade" id="rancangan-proyek" role="tabpanel" aria-labelledby="rancangan-proyek-tab">
            <p class="text-center"><b>Rancangan/Desain Proyek</b></p>
            <p>
                Rancangan produk dan jasa yang dibuat harus berkaitan dengan kewirausahaan kesejarahan, boleh berupa
                produk, boleh berupa jasa, yang berpeluang dipasarkan di Kawasan sekitar wisata sejarah di daerah
                kalian.
            </p>

            <!-- input individu 1 rancangan proyek -->
            <label for="produkJasa" class="mt-3 fw-semibold">
                Produk/Jasa yang akan dirancang
            </label><br>
            <textarea name="produkJasa" id="produkJasa" class="form-control w-100 mt-2"
                rows="5">{{ old('produkJasa', $jawabanIndividu['produk atau jasa yang akan dirancang'] ?? '') }}</textarea>

            <label for="analisaProduk" class="mt-3 fw-semibold">Analisa produk/jasa yang digunakan:</label><br>

            <textarea name="analisaProduk" id="analisaProduk" class="form-control w-100 mt-2"
                rows="5">{{ old('analisaProduk', $jawabanIndividu['Analisa produk atau jasa yang digunakan'] ?? '') }}</textarea>

            <hr>
            <p class="text-center"><b>Perencanaan Proyek</b></p>
            <p>
                Tuliskan Langkah kerja untuk merancang proyek dan jasa, dimulai dari membuat business plan.
            </p>

            <!-- input individu 2 rancangan proyek -->
            <label for="langkahKerja" class="mt-3 fw-semibold">Langkah kerja:</label><br>

            <textarea name="langkahKerja" id="langkahKerja" class="form-control w-100 mt-2"
                rows="5">{{ old('langkahKerja', $jawabanIndividu['langkah kerja'] ?? '') }}</textarea>

            <div class="row mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary my-3">Simpan Jawaban</button>
                </div>
            </div>
            @if(
                    !empty($jawabanIndividu['produk atau jasa yang akan dirancang'] ?? '') &&
                    !empty($jawabanIndividu['Analisa produk atau jasa yang digunakan'] ?? '') &&
                    !empty($jawabanIndividu['langkah kerja'] ?? '')
                )

            <div class="card-body mt-3">
                <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                    <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                        value="{{ $nilaiAnalisisIndividuKWU->nilai_akhir ?? '' }}" {{ $nilaiAnalisisIndividuKWU ? 'disabled' : '' }}>
                </div>
                <label for="feedbackIndividu">Feedback dari dosen</label><br>
                <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiAnalisisIndividuKWU ? 'disabled' : '' }}>{{ $nilaiAnalisisIndividuKWU->data_jawaban_penilai ?? '' }}</textarea>
            </div>
            @endif

            </ol>
</form>
</div>

<div class="tab-pane fade" id="pengumpulan-laporan" role="tabpanel" aria-labelledby="pengumpulan-laporan-tab">
    <!-- Tombol Unduh -->
    <a href="{{ url('/download/' . $filename) }}" class="btn btn-primary my-2"><i class="bi bi-download"></i> Unduh
        Template Laporan</a>

    <!-- Form Upload Praktik Lapangan 1 -->
    <form method="post" action="{{ route('uploadFileKewirausahaan') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="category" value="proyek individu">
        <div class="mb-3">
            <label for="formFile1" class="form-label fw-semibold">Silahkan kumpulkan Lembar Proyek Individu</label>
            <input class="form-control" type="file" id="formFile1" name="file" accept=".pdf,application/pdf">
            <small>Kumpulkan dengan format <strong>.pdf</strong></small>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <!-- Menampilkan File PDF -->
    @if (!empty($uploadedFile))
        <div class="mt-4">
            <h5>File yang Sudah Diunggah:</h5>

            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal">
                Lihat File
            </button>

            <!-- Modal -->
            <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed src="{{ asset('storage/' . $uploadedFile->file_path) }}" type="application/pdf"
                                width="100%" height="600px" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-3">
                <label for="nilaiIndividu" class="mb-2">Nilai diperoleh</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                    <input type="number" class="form-control" name="nilai_akhir" min="0" max="100" required
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                        value="{{ $nilaiUploadProyekIndividu->nilai_akhir ?? '' }}" {{ $nilaiUploadProyekIndividu ? 'disabled' : '' }}>
                </div>
                <label for="feedbackIndividu">Feedback dari dosen</label><br>
                <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai" id="feedbackIndividu" rows="5" {{ $nilaiUploadProyekIndividu ? 'disabled' : '' }}>{{ $nilaiUploadProyekIndividu->data_jawaban_penilai ?? '' }}</textarea>
            </div>
        </div>
    @endif
</div>
</div>

@endsection