@extends('layouts.main')

@section('container')

{{-- @dd($materi_b) --}}

{{-- Status Bar --}}
<div class="progress rounded" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0"
    aria-valuemax="100">
    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0.001%"
        id="status_bar"></div>
</div>

{{-- Style Drag n Drop --}}
<style>
    body {
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 20px;
    }

    .soal {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        background-color: #fff;
        justify-content: center;
    }

    .panduan {
        gap: 10px;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        background-color: #fff;
    }

    .jawaban {
        width: 200px;
        height: 150px;
        cursor: pointer;
        text-align: center;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .jawaban:hover {
        border-color: #007BFF;
    }

    .jawaban img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    .kotakJawaban {
        border: 2px dashed #aaa;
        padding: 20px;
        margin: 20px 0;
        min-height: 200px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        background-color: #f0f0f0;
        border-radius: 10px;
        position: relative;
        transition: background-color 0.3s;
    }

    .kotakJawaban.dragover {
        background-color: #d0ffd0;
    }

    .result {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .button-container button {
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .submit-button {
        background-color: #007BFF;
        color: white;
    }

    .reset-button {
        background-color: #DC3545;
        color: white;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        text-align: center;
    }

    .close,
    .closeReset {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus,
    .closeReset:hover,
    .closeReset:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .jawaban-container {
        display: flex;
        /* Use flexbox for horizontal layout */
        justify-content: space-between;
        /* Space items evenly */
        gap: 20px;
        /* Add space between items */
        margin-top: 20px;
        /* Add top margin if needed */
    }

    .jawaban-item {
        flex: 1;
        /* Make each item flexible */
        text-align: center;
        /* Center the headings */
    }

    .judul-historio,
    .judul-non-historio {
        font-size: 20px;
        /* Increase font size */
        font-weight: bold;
        /* Make text bold */
        color: #333;
        /* Darker color for better contrast */
        margin: 0 0 10px 0;
        /* Remove top margin and add space below */
    }

    .kotakJawaban2 {
        border: 2px dashed #aaa;
        padding: 20px;
        margin: 20px 0;
        min-height: 200px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        background-color: #f0f0f0;
        border-radius: 10px;
        position: relative;
        transition: background-color 0.3s;
    }

    .historio {
        background-color: #cceeff;
        /* Light blue */
    }

    .non-historio {
        background-color: #ffe6e6;
        /* Light pink */
    }

    .jawaban2 {
        width: 200px;
        height: 150px;
        cursor: pointer;
        text-align: center;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .jawaban2:hover {
        border-color: #007BFF;
    }

    .jawaban2 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    .soal2 {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        background-color: #fff;
        justify-content: center;
    }
</style>

<style>
    /* Untuk bagian Pre Test */


    .feedback {
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
        display: none;
    }

    .feedback.correct {
        background-color: #d4edda;
        color: #155724;
    }

    .feedback.wrong {
        background-color: #f8d7da;
        color: #721c24;
    }


    .options input {
        margin: 5px;
    }
</style>

<div class="mt-3">
    <h1 id="progress_halaman" hidden>{{$materi_b ?? 0}}</h1>
    <div class="row">
        <div class="col">
            <h2>B. Kesejarahan</h2>
        </div>
    </div>
    {{-- Tombol Navigasi --}}
    <div class="row mb-3 mt-3">
        <div class="col-6">
            <button class="btn btn-primary" onclick="prev()" id="prev">Sebelumnya</button>
        </div>
        <div class="col-6 text-end">
            <button class="btn btn-primary" onclick="next()" id="next">Selanjutnya</button>
            <button class="btn btn-primary" id="latihan" style="display: none">Latihan</button>
        </div>
    </div>
    <div class="row materi-b" id="pre-test-1">
        <h1>Pre Test Kesejarahan</h1>
        <div class="container">
            <div class="question" id="questionText"></div>
            <div class="options" id="optionsContainer"></div>
            <button id="checkBtn" onclick="checkAnswer()">Periksa</button>
            <div class="feedback" id="feedbackContainer"></div>
        </div>
        <form id="preTestForm" action="{{ route('simpanNilaiPretest') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
            <!-- Ganti dengan email pengguna -->
            <input type="hidden" name="nilai_akhir" id="nilaiAkhir">
            <input type="hidden" name="aspek" value="pre_test_kesejarahan">
        </form>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-1">
        <div class="col">
            <h3>Kegiatan Pembelajaran 1</h3>
            <p class="text-sm">2 JP x @50 menit = 100 menit.</p>
            <p>Sejarah sebagai salah satu
                bentuk peninggalan masa lalu yang
                harus tetap kita rawat sebagai
                ingatan kolektif manusia. Banyak
                peninggalan sejarah yang tersebar
                di berbagai sudut dunia, tak
                terkecuali di Kalimantan Selatan.
                Belajar sejarah bukan berarti hanya
                belajar tentang masa lalu yang
                tiada guna, namun akan memberikan manfaat untuk masa yang akan datang, karena
                sejarah merupakan dialog antara peristiwa masa lampau dan perkembangan di masa
                depan (Kochhar, 2008). Peninggalan tersebut salah satu bentuknya adalah bangunan
                bersejarah.
            </p>
            <p>
                Pariwisata di Indonesia mempunyai peluang besar karena memiliki daya tarik
                tersendiri dimana setiap tujuan wisatanya memiliki unsur-unsur budaya, atraksi dan
                sejarah dan setiap daerahnya memiliki ciri khas yang berbeda-beda. Undang-Undang
                Nomor 9 Tahun 1990 menjelaskan bahwa pengembangan pariwisata di Indonesia
                menggunakan konsep budaya atau culture tourism dengan mempertimbangkan
                potensi seni dan budaya yang beraneka ragam yang tersebar pada daerah tujuan
                wisata daerah wisata (Yoeti, 2006). Sejalan dengan Undang-Undang Nomor 10 Tahun
                7
                2009 yang menjelaskan bahwa peninggalan purbakala, peninggalan sejarah, seni dan
                budaya yang dimiliki oleh bangsa Indonesia merupakan sumber daya dan modal
                pembangunan kepariwisataan untuk meningkatkan kesejahteraan rakyat (Kirom,
                Sudarmiatin, & Putra, 2016).

            </p>
            <p>
                Peninggalan bersejarah mempunyai daya tarik yang besar yang dapat menarik
                wisatawan. Potensi pariwisata berbasis sejarah budaya merupakan salah satu aset
                yang memiliki potensi untuk dikembangkan oleh setiap daerah (Adi et al, 2013).
                Pengembangan potensi sektor pariwisata di daerah selain untuk menambah
                pendapatan daerah juga dapat memperkenalkan sejarah serta melestarikan budaya
                daerah wisata tersebut.

            </p>
            <p>
                Wisata sejarah adalah kegiatan wisata yang bertujuan untuk mengunjungi
                tempat-tempat yang memiliki nilai kesejarahan. Nilai kesejarahan yang terdapat pada
                daerah wisata itulah yang menjadi objek wisata sejarah yang ditawarkan. Objek wisata
                tersebut beberapa diantaranya adalah arsitektur bangunan, kebudayaan dan
                kepercayaan masa lampau (Ishak, 2020). Obyek wisata yang berupa tempat atau
                keadaan alam, tata hidup, seni budaya serta peninggalan sejara bangsa perlu
                dikembangkan secara terencana serta inovatif karena obyek wisata ini merupakan titik
                sentral dari pengembangan pariwisata nasional (Suwena & Widyamatja, 2017).

            </p>
            <p>
                Daya tarik wisata sejarah adalah para wisatawan dapat menikmati keunikan
                dari keragaman budaya dan sejarah di daerah yang dikunjunginya. Tujuan dari wisata
                sejarah bagi para wisatawan adalah mempelari budaya daerah untuk memenuhi
                kebutuhan serta kepuasan rekreasinya, selain itu mereka mendapatkan edukasi dari
                peristiwa sejarah dan budaya daerah wisata (Jamal, bustami, & Desma).
                Dikemukakan oleh Irdika (Pusaka Budaya dan Pariwisata, 2007) terdapat 10 elemen
                budaya yang menjadi daya tarik wisata yakni: (1) Kerajninan, (2) tradisi, (3) sejarah,
                (4) arsitektur, (5) makanan lokal, (6) seni musik, (7) cara hidup masyarakat, (8) agama,
                (9) bahasa dan (10) pakaian lokal. Daya tarik wisata juga dipengaruhi oleh penyajian
                dari eksistensi dan keunikan dari obyek wisatayang ada yang dikemas menjadi ragam
                atraksi wisata yang menarik.

            </p>
            <p>
                Setiap daerah memiliki sejarah budaya yang unik sehingga menjadi
                karakteristik pembeda dengan daerah lain. Perbedaan karakteristik sejarah budaya
                tersebut merupakan potensi dari pariwisata sejarah di setiap daerah (Suyatmin & Edy,
                2017). Penelitian yang dilakukan oleh Aziz (2018) menyimpulkan bahwa aspek daya
                tarik kota Banjarmasin salah satunya adalah wisata heritage dan peninggalan sejarah. Sebagai kota yang
                dijuluki sebagai kota seribu sungai, Banjarmasin juga dipenuhi
                dengan tempat-tempat bersejarah yang menjadi daya tarik wisatawan lokal maupun
                non lokal. Daya tarik wisata sejarah di kota Banjarmasin dipengaruhi oleh keberadaan
                sungai dan peninggalan sejarah kerjaan Banjar dan jaman pejuangannya. Sejarah
                kerajaan banjar juga memiliki nuansa Islami sehingga Kebanyakan dari tempat
                bersejarah yang dikunjungi adalah masjid yang dibangun pada pemerintahan zaman
                dahulu yang masih dipelihara dengan menjaga bentuk aslinya serta makam keramat
                para wali yang berpengaruh menyebarkan agama Islam di Banjarmasin.
            </p>
            <p>
                Seperti yang terjadi pada obyek wisata pasar terapung di Kuin yang mengalami
                penurunan aksistensinya karena aktivitas dan kegiatan ekonomi masyarakat
                berpindah ke darat (Pradana, 2020). Dikembangkannya Pasar Terapung buatan di
                Siring Tandean juga membuat Pasar Terapung Muara Kuin semakin terpinggirkan.
                Masalah lain adalah Kurangnya pengemasan daya tarik obyek wisata dimana
                seharusnya daerah tujuan wisata memiliki keunikan, kekhasan dan dan daya tarik
                tersendiri, baik berupa alam maupun masyarakat serta budayanya (Huiwen & Hassink,
                2017). Selain itu faktor lingkungan disekitar juga mempengaruhi seperti jalan yang
                sempit, kondisi lingkungan dan fasilitas yang kurang memadai, serta waktu menikmati
                wisata terbatas dari pukul 03.00 dini hari hingga pukul 07.00 pagi wita saja. Penurunan
                keberadaan obyek wisata Pasar Terapung Kuin juga menyebabkan hilangnya nilainilai
                sosial
                dan
                budaya
                yang
                terkandung
                di
                dalam
                Pasar
                Terapung
                itu
                sendiri
                (Gibson,

                2015).


            </p>
            <p>
                Peninggalan bersejarah mempunyai daya tarik yang besar yang juga dapat
                menarik wisatawan mancanegara. Sehingga untuk mengembangkan wisata sejarah
                Kota Banjarmasin dengan memberdayakan elemen dan lansekap budaya sebagai
                objek wisata serta nilai-nilai kultural yang terdapat di Kota Banjarmasin, diperlukan
                sebuah identifikasi guna menemukan potensi objek wisata sejarah berdasarkan
                kelayakan lanskap untuk selanjutnya diketahui strategi pengembangan berdasarkan
                variabel kelayakan lanskap yang perlu dioptimalkan guna meningkatkan
                kesejahteraan kota dan masyarakat.

            </p>
        </div>
    </div>
    <div class="row materi-b" id="kuis-kesejarahan">
        <div class="col">
            <div class="container">
                <h1 class="title">Manakah 5 objek wisata yang ada di Kalimantan Selatan?</h1>
                <div class="panduan">
                    <h4>Panduan Pengerjaan</h4>
                    <ol>
                        <li>Pilih Gambar yang menurut Anda Benar</li>
                        <li>Seret Gambar ke kotak Jawaban</li>
                        <li>Untuk Mengganti Jawaban seret kembali gambar ke atas kotak soal</li>
                        <li>Tekan Submit ketika jawaban sudah dirasa benar</li>
                        <li>Tekan Reset ketika Anda ingin mengulang </li>
                    </ol>
                </div>
                <div class="soal">
                    <div class="jawaban" draggable="true" id="jawaban1" data-correct="true">
                        <img src="img/1.jpg" alt="Gambar 1">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban2" data-correct="true">
                        <img src="img/2.jpg" alt="Gambar 2">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban3" data-correct="true">
                        <img src="img/3.jpg" alt="Gambar 3">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban4" data-correct="true">
                        <img src="img/4.jpg" alt="Gambar 4">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban5" data-correct="true">
                        <img src="img/5.jpg" alt="Gambar 5">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban6" data-correct="false">
                        <img src="img/6.jpg" alt="Gambar 6">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban7" data-correct="false">
                        <img src="img/7.jpeg" alt="Gambar 7">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban8" data-correct="false">
                        <img src="img/8.jpeg" alt="Gambar 8">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban9" data-correct="false">
                        <img src="img/9.jpeg" alt="Gambar 9">
                    </div>
                    <div class="jawaban" draggable="true" id="jawaban10" data-correct="false">
                        <img src="img/10.jpg" alt="Gambar 10">
                    </div>
                </div>

                <div class="kotakJawaban" id="kotakJawaban"></div>

            </div>

            <!-- Historio dan non Historio -->

            <div class="container">
                <h1 class="title">Kelompokkan gambar berikut menjadi 2 bagian yaitu historio dan non historio!</h1>
                <div class="panduan">
                    <h4>Panduan Pengerjaan</h4>
                    <ol>
                        <li>Pilih Gambar yang menurut Anda Benar</li>
                        <li>Seret Gambar ke kotak Jawaban</li>
                        <li>Letakkan gambar historio disebelah kanan dan non historio disebelah kiri</li>
                        <li>Untuk Mengganti Jawaban seret kembali gambar ke atas kotak soal</li>
                        <li>Tekan Submit ketika jawaban sudah dirasa benar</li>
                        <li>Tekan Reset ketika Anda ingin mengulang </li>
                    </ol>
                </div>
                <div class="soal2">
                    <div class="jawaban2" draggable="true" id="jawaban11" data-category="historio">
                        <img src="img/MasjidSultanSuriansyah.jpg" alt="Masjid Sultan Suriansyah">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban12" data-category="non-historio">
                        <img src="img/bajuin.jpg" alt="Air Terjun Bajuin">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban13" data-category="historio">
                        <img src="img/wasaka.jpg" alt="Museum Wasaka">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban14" data-category="non-historio">
                        <img src="img/danauSeran.jpeg" alt="Danau Seran">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban15" data-category="historio">
                        <img src="img/CandiAgung.jpg" alt="Candi Agung">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban16" data-category="historio">
                        <img src="img/pulauKembang.jpg" alt="Pulau Kembang">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban17" data-category="non-historio">
                        <img src="img/bukitBirah.jpg" alt="Bukit Birah">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban18" data-category="historio">
                        <img src="img/makamPangeranAntasari.jpg" alt="Makam Pangeran Antasari">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban19" data-category="non-historio">
                        <img src="img/loksado.jpg" alt="Loksado">
                    </div>
                    <div class="jawaban2" draggable="true" id="jawaban20" data-category="non-historio">
                        <img src="img/pantaiAngsana.jpg" alt="Pantai Angsana">
                    </div>
                </div>

                <div class="jawaban-container">
                    <!-- Kotak Historio -->
                    <div class="jawaban-item">
                        <h3 class="judul-historio">Historio</h3>
                        <div class="kotakJawaban2 historio" id="kotakHistorio"></div>
                    </div>

                    <!-- Kotak Non-Historio -->
                    <div class="jawaban-item">
                        <h3 class="judul-non-historio">Non-Historio</h3>
                        <div class="kotakJawaban2 non-historio" id="kotakNonHistorio"></div>
                    </div>
                </div>
            </div>
            {{-- END --}}

            <div class="text-center">
                <button id="submitBtn" class="btn btn-primary">Submit</button>
                <button id="resetBtn" class="btn btn-warning">Reset</button>
            </div>

            <!-- Modal untuk menampilkan nilai -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2>Hasil</h2>
                    <p id="nilaiTotal" class="nilai-text">Total Nilai: 0</p>
                    <form id="tutupForm" action="{{ route('DND') }}" method="POST">
                        @csrf
                        <input type="hidden" id="nilaiAkhirInput" name="nilai_akhir">
                        <input type="hidden" name="aspek" value="poin_DND">
                        <button type="submit" id="closeModalBtn" class="btn btn-primary">Tutup</button>
                    </form>
                </div>
            </div>
            {{-- End --}}

            <!-- Modal untuk konfirmasi reset -->
            <div id="resetModal" class="modal">
                <div class="modal-content">
                    <h2>Konfirmasi Reset</h2>
                    <button id="confirmResetBtn" class="btn btn-danger">Ya, Reset</button><br>
                    <button id="cancelResetBtn" class="btn btn-secondary">Batal</button>
                </div>
            </div>


            <script>

                const jawabanElements = document.querySelectorAll('.jawaban');
                const kotakJawaban = document.getElementById('kotakJawaban');
                const soalContainer = document.querySelector('.soal');
                let correctAnswers = 0;

                jawabanElements.forEach(jawaban => {
                    jawaban.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('text/plain', jawaban.id);
                    });

                    jawaban.addEventListener('dragend', () => {
                        jawaban.classList.remove('dragged');
                    });
                });

                kotakJawaban.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    kotakJawaban.classList.add('dragover');
                });

                kotakJawaban.addEventListener('dragleave', () => {
                    kotakJawaban.classList.remove('dragover');
                });

                kotakJawaban.addEventListener('drop', (e) => {
                    e.preventDefault();
                    kotakJawaban.classList.remove('dragover');

                    const jawabanId = e.dataTransfer.getData('text/plain');
                    const jawabanElement = document.getElementById(jawabanId);

                    if (!jawabanElement.classList.contains('jawaban')) {
                        return;
                    }

                    if (kotakJawaban.childElementCount >= 5) {
                        return;
                    }

                    kotakJawaban.appendChild(jawabanElement);
                    jawabanElement.draggable = false;
                    jawabanElement.classList.add('dragged');

                    if (jawabanElement.dataset.correct === 'true') {
                        correctAnswers++;
                    }
                });

                soalContainer.addEventListener('dragover', (e) => {
                    e.preventDefault();
                });

                soalContainer.addEventListener('drop', (e) => {
                    e.preventDefault();

                    const jawabanId = e.dataTransfer.getData('text/plain');
                    const jawabanElement = document.getElementById(jawabanId);

                    if (jawabanElement.parentNode === kotakJawaban) {
                        kotakJawaban.removeChild(jawabanElement);
                        soalContainer.appendChild(jawabanElement);
                        jawabanElement.draggable = true;
                        jawabanElement.classList.remove('dragged');

                        if (jawabanElement.dataset.correct === 'true') {
                            correctAnswers--;
                        }
                    }
                });

                // DND bagian 2
                const kotakHistorio = document.getElementById('kotakHistorio');
                const kotakNonHistorio = document.getElementById('kotakNonHistorio');
                const jawaban2Elements = document.querySelectorAll('.jawaban2');
                const soalContainer2 = document.querySelector('.soal2');

                jawaban2Elements.forEach(jawaban2 => {
                    jawaban2.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('text/plain', jawaban2.id);
                    });

                    jawaban2.addEventListener('dragend', () => {
                        jawaban2.classList.remove('dragged');
                    });
                });

                kotakHistorio.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    kotakHistorio.classList.add('dragover');
                });

                kotakHistorio.addEventListener('dragleave', () => {
                    kotakHistorio.classList.remove('dragover');
                });

                kotakHistorio.addEventListener('drop', (e) => {
                    e.preventDefault();
                    kotakHistorio.classList.remove('dragover');

                    const jawabanId = e.dataTransfer.getData('text/plain');
                    const jawabanElement = document.getElementById(jawabanId);

                    if (!jawabanElement.classList.contains('jawaban2')) {
                        return;
                    }

                    kotakHistorio.appendChild(jawabanElement);
                    jawabanElement.draggable = false;
                    jawabanElement.classList.add('dragged');
                });

                kotakNonHistorio.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    kotakNonHistorio.classList.add('dragover');
                });

                kotakNonHistorio.addEventListener('dragleave', () => {
                    kotakNonHistorio.classList.remove('dragover');
                });

                kotakNonHistorio.addEventListener('drop', (e) => {
                    e.preventDefault();
                    kotakNonHistorio.classList.remove('dragover');

                    const jawabanId = e.dataTransfer.getData('text/plain');
                    const jawabanElement = document.getElementById(jawabanId);

                    if (!jawabanElement.classList.contains('jawaban2')) {
                        return;
                    }

                    kotakNonHistorio.appendChild(jawabanElement);
                    jawabanElement.draggable = false;
                    jawabanElement.classList.add('dragged');
                });

                soalContainer2.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    soalContainer2.classList.add('dragover');
                });

                soalContainer2.addEventListener('dragleave', () => {
                    soalContainer2.classList.remove('dragover');
                });

                soalContainer2.addEventListener('drop', (e) => {
                    e.preventDefault();
                    soalContainer2.classList.remove('dragover');

                    const jawabanId = e.dataTransfer.getData('text/plain');
                    const jawabanElement = document.getElementById(jawabanId);

                    if (jawabanElement.classList.contains('jawaban2')) {
                        soalContainer2.appendChild(jawabanElement);
                        jawabanElement.draggable = true;
                        jawabanElement.classList.remove('dragged');
                    }
                });

                const submitBtn = document.getElementById('submitBtn');
                const modal = document.getElementById('myModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const nilaiTotalElement = document.getElementById('nilaiTotal');

                submitBtn.addEventListener('click', () => {
                    // Hitung nilai untuk bagian pertama
                    let bagianPertamaNilai = correctAnswers * 10; // Setiap jawaban benar bernilai 10

                    // Hitung nilai untuk bagian historio dan non-historio
                    let historioNilai = 0;
                    let nonHistorioNilai = 0;

                    const historioJawaban = document.querySelectorAll('#kotakHistorio .jawaban2[data-category="historio"]');
                    historioNilai = historioJawaban.length * 5; // Setiap jawaban benar bernilai 5

                    const nonHistorioJawaban = document.querySelectorAll('#kotakNonHistorio .jawaban2[data-category="non-historio"]');
                    nonHistorioNilai = nonHistorioJawaban.length * 5; // Setiap jawaban benar bernilai 5

                    const totalNilai = bagianPertamaNilai + historioNilai + nonHistorioNilai;

                    // Masukkan total nilai ke dalam input hidden
                    document.getElementById('nilaiAkhirInput').value = totalNilai;

                    // Tampilkan nilai di modal
                    nilaiTotalElement.textContent = `Total Nilai: ${totalNilai}`;

                    // Tampilkan modal
                    modal.style.display = 'block';
                });

                // Tutup modal saat pengguna klik tombol "Tutup"
                closeModalBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                });

                // Tutup modal saat pengguna klik di luar modal
                window.addEventListener('click', (event) => {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                });


                // Variabel untuk modal reset
                const resetBtn = document.getElementById('resetBtn');
                const resetModal = document.getElementById('resetModal');
                const confirmResetBtn = document.getElementById('confirmResetBtn');
                const cancelResetBtn = document.getElementById('cancelResetBtn');

                // Fungsi untuk menampilkan modal reset
                resetBtn.addEventListener('click', () => {
                    resetModal.style.display = 'block';
                });

                // Fungsi konfirmasi reset (ketika tombol "Ya, Reset" ditekan)
                confirmResetBtn.addEventListener('click', () => {
                    // Reset jawaban dari bagian pertama
                    const jawabanElements = document.querySelectorAll('.jawaban');
                    jawabanElements.forEach(jawaban => {
                        if (jawaban.parentNode !== soalContainer) {
                            jawaban.parentNode.removeChild(jawaban);
                            soalContainer.appendChild(jawaban);
                            jawaban.draggable = true;
                            jawaban.classList.remove('dragged');
                        }
                    });

                    // Reset counter correctAnswers
                    correctAnswers = 0;

                    // Reset jawaban dari bagian historio dan non-historio
                    const jawaban2Elements = document.querySelectorAll('.jawaban2');
                    jawaban2Elements.forEach(jawaban2 => {
                        if (jawaban2.parentNode === kotakHistorio || jawaban2.parentNode === kotakNonHistorio) {
                            if (jawaban2.parentNode === kotakHistorio) {
                                kotakHistorio.removeChild(jawaban2);
                            } else {
                                kotakNonHistorio.removeChild(jawaban2);
                            }
                            soalContainer2.appendChild(jawaban2);
                            jawaban2.draggable = true;
                            jawaban2.classList.remove('dragged');
                        }
                    });

                    // Reset nilai yang ditampilkan
                    nilaiTotalElement.textContent = '';

                    // Tutup modal reset
                    resetModal.style.display = 'none';
                });

                // Fungsi untuk menutup modal reset jika tombol "Batal" ditekan
                cancelResetBtn.addEventListener('click', () => {
                    resetModal.style.display = 'none'; // Hanya menutup modal tanpa reset
                });

                // Tutup modal reset jika pengguna mengklik di luar modal
                window.addEventListener('click', (event) => {
                    if (event.target == resetModal) {
                        resetModal.style.display = 'none';
                    }
                });



            </script>
        </div>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-2">
        <div class="col">
            <h3>Kegiatan Pembelajaran 2</h3>
            <p class="text-sm">6 JP x @50 menit = 300 menit
            </p>
            <p>
                <b>CPMK:</b>
            </p>
            <ol>
                <li>Mahasiswa mampu mengorganisasikan objek kesejarahan berdasarkan hasil identifikasi dan
                    eksplorasi dalam pemetaan.</li>
                <li>Mahasiswa mampu mengasesmen objek kesejarahan berdasarkan hasil identifikasi.
                </li>
                <li>Mahasiswa mampu mendesain potensi usaha berdasarkan hasil kelayakan objek (<i>object pattern and
                        feasibility</i>).
                </li>
            </ol>
            <div class="kotak bg-warning-subtle">
                Untuk dapat mecapai Kegiatan Pembelajaran 2, silahkan eksplorasi lebih lanjut terkait kesejarahan yang
                ada di Kalimantan Selatan. Dan kerjakan analisi yang ada pada halaman selanjutnya >>
            </div>
        </div>
    </div>
    <div class="row materi-b" id="lembar-analisa-kelompok">
        <div class="col">
            <h3>LEMBAR ANALISA INDIVIDU</h3>
            <p class="text-lg">AKTIVITAS EKSPLORASI MAHASISWA</p>
            <p>
                Berdasarkan hasil identifikasi terkait objek kesejarahan yang ada di daerah kalian, petakanlah
                objek-objek kesejarahan tersebut.
                <br>Lakukanlah analisa secara individu!
            </p>
            <p class="kotak bg-warning-subtle">
                Silahkan berselancar di dunia maya / lingkungan sekitar untuk melakuka analisis
            </p>

            <div class="text-center bordered mb-3">
                {{-- <video width="900" height="507" controls>
                    <source src="img/video_historiopreneurship.mp4" type="video/mp4">
                </video> --}}
                <iframe width="900" height="507" src="https://www.youtube.com/embed/P4B-OnP8ISc?si=YBNeIwxF_qJmlo3E"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <form method="post" id="formIndividu" action="{{ route('simpanJawabanIndividu2') }}">
            @csrf
            @foreach (range(1, 10) as $i)
                <div class="row mt-3">
                    <div class="col">
                        <label for="objek{{ $i }}" data-value="{{ $i }}">Objek {{ $i }}</label><br>
                        <textarea name="objek{{ $i }}" id="objek{{ $i }}"
                            rows="5">{{ old('objek' . $i, $jawabanIndividuII->where('no_objek', $i)->first()->jawaban ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach

            <div class="row mt-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary" data-form="formIndividu">Simpan Jawaban</button>
                </div>
            </div>
        </form>


    </div>
    <div class="row materi-b" id="lembar-analisa-individu">
        <div class="col">
            <h2>LEMBAR ANALISA INDIVIDU</h2>
            <h3>AKTIVITAS UNTUK KERJA</h3>
            <p>Berdasarkan hasil identifikasi dari setiap kelompok, analisa dan asesmen lah hasil pemetaan
                tersebut dengan melengkapi kolom di bawah ini. Selanjutnya, diskusikan di kelas.
            </p>
            <p class="text-lg">LENGKAPILAH KOLOM DI BAWAH INI!</p>
        </div>
        <!-- Analisis Individu -->
        <form method="post" action="{{ route('simpanAnalisisIndividu') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row mt-3">
                        <div class="col">
                            <label for="objekWisata">Objek Wisata</label><br>
                            <textarea name="objekWisata" id="objekWisata"
                                rows="5">{{ old('objekWisata', $jawabanIndividu['wisata'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="objekKesejarahan">Objek Kesejarahan</label><br>
                            <textarea name="objekKesejarahan" id="objekKesejarahan"
                                rows="5">{{ old('objekKesejarahan', $jawabanIndividu['kesejarahan'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="urgensiObjekKesejarahan">Urgensi Objek Kesejarahan</label><br>
                            <textarea name="urgensiObjekKesejarahan" id="urgensiObjekKesejarahan"
                                rows="5">{{ old('urgensiObjekKesejarahan', $jawabanIndividu['urgensi objek kesejarahan'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="urgensiKesejarahan">Urgensi Kesejarahan</label><br>
                            <textarea name="urgensiKesejarahan" id="urgensiKesejarahan"
                                rows="5">{{ old('urgensiKesejarahan', $jawabanIndividu['urgensi kesejarahan'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="row mt-4">
            <div class="col">
                <h3 class="text-center">INDIKATOR PENILAIAN KELAYAKAN OBJEK KESEJARAHAN </h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aspek</th>
                        <th>Bobot</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tr>
                    <td>1.</td>
                    <td>Daya Tarik</td>
                    <td>6</td>
                    <td>Daya tarik merupakan faktor utama
                        alasan seseorang melakukan
                        perjalanan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Aksesibilitas</td>
                    <td>5</td>
                    <td>Aksesbilitas merupakan faktor penting
                        yang mendukung wisatawan dapat
                        melakukan kegiatan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Sarana Prasarana</td>
                    <td>3</td>
                    <td>Sarana dan prasarana bersifat
                        sebagai penunjang dalam kegiatan
                        wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Partisipasi Masyarakat</td>
                    <td>6</td>
                    <td>Partisipasi masyarakat adalah
                        keterlibatan sukarela oleh masyarakat
                        dalam pembangunan objek sejarah di
                        lingkungan mereka sendiri.</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="text-center mt-4">LAMPIRAN <br> FORM SYARAT KELAYAKAN OBJEK KESEJARAHAB</h3>
                <table class="table table-bordered  table-responsive-md">
                    <thead>

                        <tr>
                            <th rowspan="2">NO</th>
                            <th rowspan="2">ASPEK</th>
                            <th rowspan="2">Sub Aspek</th>
                            <th colspan="5">Skor</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tr>
                        <td rowspan="4">1.</td>
                        <td rowspan="4">Daya Tarik</td>
                        <td>1. Memiliki keunikan atau ciri khas sejarah lokal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Objek sejarah memiliki lokasi yang bersih</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Kawasan objek sejarah terjamin keamanannya</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Keserasian bangunan objek dengan lingkungan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3">2.</td>
                        <td rowspan="3">Aksesbilitas</td>
                        <td>1. Kondisi jalan menuju objek sejarah terlampau mulus</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Dekat dari pusat kota</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Waktu tempuh dari pusat kota tidak terlalu lama/jauh</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="4">3.</td>
                        <td rowspan="4">Sarana Prasarana</td>
                        <td>1. Memiliki fasilitas umum seperti toilet dan tempat wudhu</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Memiliki <i>gif/merchandise store</i> di sekitar objek sejarah</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Memiliki warung dan rumah makan di sekitar objek sejarah</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Memiliki areal parkir yang cukup untuk wisatawan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="7">4.</td>
                        <td rowspan="7">Partisipasi Masyarakat</td>
                        <td>1. Objek kesejarahan dapat mensejahterakan tuan rumah atau masyarakat sekitar</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Masyarakat sekitar menyambut kehadiran wisatawan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Masyarakat menyediakan fasilitas kenyamanan wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Masyarakat menyediakan pemandu wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5. Pelaku wisata berasal dari masyarak lokal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6. Terdapat penjual cindremata/oleh-oleh khas wisata setempat yang dibuat masyarakat lokal
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7. Masyarakat turut serta dalam menjaga keamanan, kenyamanan, ketertiban, dan kebersihan
                            daerah wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-3">
        <div class="col">
            <h3>Kegiatan Pembelajaran 3</h3>
            <p class="text-sm">4 JP x @50 menit = 200 menit </p>
            <p><b>CPMK:</b></p>
            <ol>
                <li>Mahasiswa mampu menyusun laporan terkait rambu-rambu wisata kesejarahan
                    berbasis kewirausahaan berdasarkan hasil observasi lapangan.
                </li>
            </ol>
            <p class="text-lg">LAPORAN KEGIATAN</p>
            <p>AKTIVITAS UNJUK KERJA</p>
            <p>Berdasarkan hasil penilaian kelayakan objek sejarah yang dipilih dari setiap kelompok,
                buatlah laporan kegiatan tersebut dengan memuat “object pattern and feasibility”,
                selanjutnya diskusikan di kelas. </p>
            <!-- Form Upload Kegiatan Pembelajaran 3 -->
            <form method="post" action="{{ route('uploadFileKesejarahan') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="kegiatan pembelajaran 3">
                <div class="mb-3">
                    <label for="formFile1" class="form-label">Silahkan kumpulkan tugas untuk Kegiatan Pembelajaran
                        3!</label>
                    <input class="form-control" type="file" id="formFile1" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
    <div class="row materi-b" id="post-test-1">
        <h1>Post Test Kesejarahan</h1>
        <div class="container">
            <div class="question" id="PostquestionText"></div>
            <div class="options" id="PostoptionsContainer"></div>
            <button id="PostcheckBtn" onclick="PostcheckAnswer()">Periksa</button>
            <div class="feedback" id="PostfeedbackContainer"></div>
        </div>
        <form id="postTestForm" action="{{ route('simpanNilaiPosttest') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="nilai_akhir" id="nilaiAkhir2">
            <input type="hidden" name="aspek" value="post_test_kesejarahan">
        </form>
    </div>

    <div class="row materi-b" id="refleksi">
        <div class="col">
            <h2>REFLEKSI</h2>
            <p>Setelah mempelajari buku ajar ini, bagaimana pemahaman kalian terhadap materi?

                Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar- benarnya sesuai dengan
                perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang
                (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi
                ini! </p>
            <form method="post" action="{{ route('simpanRefleksiKesejarahan') }}">
                @csrf
                <input type="hidden" name="kategori" value="refleksi kesejarahan">
                <div class="icon-radio col mt-3">
                    @foreach(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas'] as $value)
                        <label>
                            <input type="radio" name="respon" value="{{ $value }}" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == $value ? 'checked' : '' }} />
                            <i
                                class="fa-solid fa-face-{{ $value == 'sangat puas' ? 'laugh-beam' : ($value == 'puas' ? 'smile' : ($value == 'biasa saja' ? 'grin-beam-sweat' : ($value == 'kurang puas' ? 'sad-cry' : 'dizzy'))) }}"></i>
                        </label>
                    @endforeach
                </div>

                <p><b>Jawablah pertanyaan berikut!</b></p>
                <div class="row mt-3">
                    <ol>
                        <li class="mt-3">
                            <label for="sudah_dipelajari">Apa yang sudah kalian pelajari?</label> <br>
                            <textarea name="sudah_dipelajari" id="sudah_dipelajari"
                                rows="5">{{ old('sudah_dipelajari', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->jawaban ?? '') }}</textarea>
                        </li>
                        <li class="mt-3">
                            <label for="dikuasai">Apa yang kalian kuasai dari materi ini?</label> <br>
                            <textarea name="dikuasai" id="dikuasai"
                                rows="5">{{ old('dikuasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('dikuasai')->jawaban ?? '') }}</textarea>
                        </li>
                        <li class="mt-3">
                            <label for="belum_dikuasai">Bagian apa yang belum kalian kuasai?</label> <br>
                            <textarea name="belum_dikuasai" id="belum_dikuasai"
                                rows="5">{{ old('belum_dikuasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('belum dikuasai')->jawaban ?? '') }}</textarea>
                        </li>
                        <li class="mt-3">
                            <label for="upaya_menguasai">Apa upaya kalian untuk menguasai yang belum kalian
                                kuasai?</label>
                            <br>
                            <textarea name="upaya_menguasai" id="upaya_menguasai"
                                rows="5">{{ old('upaya_menguasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('upaya untuk menguasai')->jawaban ?? '') }}</textarea>
                        </li>
                    </ol>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

{{-- Pop up --}}
<style>
    .popup {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .popup-content {
        position: relative;
        margin: 15% auto;
        padding: 20px;
        width: 300px;
        background-color: white;
        border-radius: 10px;
        text-align: center;
    }

    .closeBtn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 20px;
        cursor: pointer;
    }

    #pointsDisplay {
        font-size: 30px;
        font-weight: bold;
    }
</style>
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="closeBtn">&times;</span>
        <h3>Selamat anda mendapatkan poin</h3>
        <p id="pointsDisplay" class="text-center">0</p>
    </div>
</div>
<script>

</script>

{{-- Mengirim progress ke dalam database --}}
<form id="updateHalaman" action="{{url('updateAksesHalaman')}}" method="GET" hidden>
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" name="halaman" value="materi_b">
    <input type="hidden" name="progress" id="halaman">
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sistem poin
    var popup = document.getElementById("popup");
    var closeBtn = document.getElementsByClassName("closeBtn")[0];
    var pointsDisplay = document.getElementById("pointsDisplay");

    // Misalkan poin yang ingin ditampilkan adalah 150
    var points = 175;

    function openPopupBtnS() {
        pointsDisplay.textContent = points;
        popup.style.display = "block";
    }


    closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Menutup popup jika pengguna mengklik di luar konten popup
    window.addEventListener("click", function (event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    });

    // Mengambil semua class sub
    const materi_a = document.getElementsByClassName('materi-b');

    // Navigasi Soal
    var $sub = document.getElementById('progress_halaman').innerHTML;
    var $progress = document.getElementById('progress_halaman').innerHTML;

    // Navigasi tombol
    function nav_tombol() {

        if ($sub == 0) {
            document.getElementById('prev').disabled = true;
        } else if ($sub == 7) {
            document.getElementById('next').innerHTML = "refleksi";
            document.getElementById('next').addEventListener('click', function () {
                window.location.hash = "#refleksi"
            })
        } else {
            document.getElementById('next').innerHTML = "Selanjutnya";
            document.getElementById('prev').disabled = false;
            document.getElementById('next').disabled = false;
        }
    }
    nav_tombol();

    // Hide semua bab
    function hide_semua_sub() {
        for (let i = 0; i <= 8; i++) {
            console.log(materi_a[i])
            materi_a[i].style.display = 'none';
        }
        console.log($sub, $progress)
    }
    hide_semua_sub();

    // Menampilkan sub
    function show_sub($no) {
        materi_a[$no].style.display = 'block';
    }
    show_sub($sub);



    // Status Bar

    const status_bar = document.getElementById('status_bar');
    function update_status() {
        let persen = $progress * 12.5;
        status_bar.style.width = `${persen}%`;
    }
    update_status();

    // Testing
    // console.log(materi_a)
    let progressHalaman = document.getElementById('halaman');

    if ($sub == 5) {
        openPopupBtnS();

    }

    function next() {
        console.log('Selanjutnya', $sub)
        hide_semua_sub();
        $sub++;
        if ($sub > $progress) {
            $progress++;
            progressHalaman.value = $progress;
            updateHalaman.submit()

        }
        show_sub($sub);
        nav_tombol()
        active_sub('nav')

    }

    function prev() {
        console.log('Sebelumnya', $sub)
        hide_semua_sub();
        $sub--;
        show_sub($sub);
        nav_tombol()
        active_sub('nav')
    }

    // Mempertahankan sidebar tetap aktif
    let $sides_B = document.querySelectorAll('#side_B li')
    console.log("INI BAGIAN SIDE B", $sides_B)

    for (let i = 0; i <= $progress; i++) {
        console.log('BY SESSION', $sides_B[i]);
        $sides_B[i].querySelector('a').classList.add('active');
        $sides_B[i].querySelector('a').classList.remove('disabled');
        $sides_B[i].querySelector('a').classList.remove('text-gray');

        // Mengubah lock menjadi dot
        $sides_B[i].querySelector('i').classList.remove('bi-lock')
        $sides_B[i].querySelector('i').classList.add('bi-dot')
    }

</script>
<!-- SweatAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // document.getElementById('submitBtn').addEventListener('click', function (e) {
    //     e.preventDefault();

    //     Swal.fire({
    //         title: 'Apakah Anda yakin?',
    //         text: "Pastikan semua jawaban sudah benar sebelum disimpan!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, simpan!',
    //         cancelButtonText: 'Batal'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             document.querySelector('form').submit();
    //         }
    //     });
    // });
</script>
<script>
    document.querySelectorAll('.submitBtn').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const formId = this.getAttribute('data-form');
            const form = document.getElementById(formId);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan semua jawaban sudah benar sebelum disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Script Pre Test
    const questions = [
        {
            question: "Museum Wasaka terletak di kota mana?",
            options: ["Balikpapapan", "Samarinda", "Banjarmasin", "Palangka Raya"],
            correct: 2,
            explanation: ""
        },
        {
            question: "Arti dari “Waja Sampai Ka Puting” dalam Bahasa Banjar adalah?",
            options: ["Teguh sampai akhir", "Sejarah sampai selamanya", "Bersatu Menuju Kemenangan", "Berjuan tanpa henti"],
            correct: 0,
            explanation: ""
        },
        {
            question: "Tugu 9 November Banjarmasin memiliki bentuk seperti apa?",
            options: ["Monumen berbentuk lingkaran", "Menara yang menjulang tinggi", "Pahlawan sedang memegang bendera", "Pahlawan dengan pedang terhunus"],
            correct: 1,
            explanation: ""
        },
        {
            question: "Apa nama kerajaan sebelum menjadi Kesultanan Banjar?",
            options: ["Kerajaan Tanjungpura", "Kerajaan Daha", "Kerajaan Kutai", "Kerajaan Martapura"],
            correct: 1,
            explanation: ""
        },
        {
            question: "Apa nama masjid terbesar di Banjarmasin yang menjadi ikon kota?",
            options: ["Masjid Al-Falah", "Masjid Agung Al-Karomah", "Masjid Sabilal Muhtadin", "Masjid Jami Banjarmasin"],
            correct: 2,
            explanation: ""
        }
    ];

    let currentQuestion = 0;
    let correctCount = 0;

    function loadQuestion() {
        console.log("Load Question")
        const questionText = document.getElementById("questionText");
        const optionsContainer = document.getElementById("optionsContainer");
        const feedbackContainer = document.getElementById("feedbackContainer");
        const checkBtn = document.getElementById("checkBtn");

        // Reset question and feedback
        questionText.innerText = questions[currentQuestion].question;
        optionsContainer.innerHTML = '';
        feedbackContainer.style.display = 'none';
        feedbackContainer.innerHTML = '';
        checkBtn.innerText = 'Periksa';
        checkBtn.disabled = false;

        questions[currentQuestion].options.forEach((option, index) => {
            const optionLabel = document.createElement("label");
            const optionRadio = document.createElement("input");
            optionRadio.type = "radio";
            optionRadio.name = "option";
            optionRadio.value = index;
            optionLabel.appendChild(optionRadio);
            optionLabel.appendChild(document.createTextNode(option));
            optionsContainer.appendChild(optionLabel);
            optionsContainer.appendChild(document.createElement("br"));
        });
    }

    function checkAnswer() {
        console.log('Cek Jawaban');

        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (!selectedOption) return;

        const feedbackContainer = document.getElementById("feedbackContainer");
        const checkBtn = document.getElementById("checkBtn");

        const selectedValue = parseInt(selectedOption.value);
        const correctValue = questions[currentQuestion].correct;

        feedbackContainer.style.display = 'block';

        if (selectedValue === correctValue) {
            correctCount++;
            feedbackContainer.className = 'feedback correct';
            feedbackContainer.innerHTML = "✅ Jawaban benar! " + questions[currentQuestion].explanation;
        } else {
            feedbackContainer.className = 'feedback wrong';
            feedbackContainer.innerHTML = "❌ Jawaban salah! " + questions[currentQuestion].explanation;
        }

        checkBtn.innerText = "Selanjutnya";
        checkBtn.onclick = nextQuestion;
    }

    function nextQuestion() {
        currentQuestion++;
        if (currentQuestion < questions.length) {
            loadQuestion();
            const checkBtn = document.getElementById("checkBtn");
            checkBtn.onclick = checkAnswer;
            checkBtn.innerText = "Periksa";
        } else {
            // Tampilkan hasil dengan SweetAlert
            Swal.fire({
                title: "Pre-test selesai!",
                text: "Jumlah jawaban benar: " + correctCount,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                // Set nilai di form dan submit
                document.getElementById("nilaiAkhir").value = correctCount *20;
                document.getElementById("preTestForm").submit();
            });
        }
    }


    loadQuestion();

    // Post Test
    const postTestQuestions = [
        {
            question: "Siapakah pendiri Kesultanan Banjar?",
            options: ["Sultan Adam", "Sultan Suriansyah", "Pangeran Antasari", "Pangeran Hidayatullah"],
            correct: 1,
            explanation: "Sultan Suriansyah adalah pendiri Kesultanan Banjar dan raja pertama yang memeluk Islam."
        },
        {
            question: "Perang Banjar terjadi pada tahun?",
            options: ["1860-1865", "1859-1905", "1845-1862", "1870-1885"],
            correct: 1,
            explanation: "Perang Banjar dimulai pada tahun 1859 dan berlangsung hingga 1905 melawan kolonial Belanda."
        },
        {
            question: "Siapa yang memimpin Perang Banjar setelah Pangeran Antasari?",
            options: ["Sultan Adam", "Pangeran Hidayatullah", "Pangeran Diponegoro", "Sultan Suriansyah"],
            correct: 1,
            explanation: "Pangeran Hidayatullah melanjutkan kepemimpinan Perang Banjar setelah Pangeran Antasari wafat."
        },
        {
            question: "Apa nama kerajaan sebelum menjadi Kesultanan Banjar?",
            options: ["Kerajaan Tanjungpura", "Kerajaan Daha", "Kerajaan Kutai", "Kerajaan Martapura"],
            correct: 1,
            explanation: "Kerajaan Daha adalah kerajaan Hindu yang kemudian menjadi Kesultanan Banjar setelah Sultan Suriansyah memeluk Islam."
        },
        {
            question: "Pahlawan nasional dari Kalimantan Selatan adalah?",
            options: ["Pangeran Diponegoro", "Cut Nyak Dien", "Pangeran Antasari", "Sultan Hasanuddin"],
            correct: 2,
            explanation: "Pangeran Antasari adalah pahlawan nasional dari Kalimantan Selatan yang memimpin Perang Banjar."
        }
    ];

    let no_soal = 0;
    let benarPostTest = 0;

    function PostloadQuestion() {
        console.log("Load Question")
        const PostquestionText = document.getElementById("PostquestionText");
        const PostoptionsContainer = document.getElementById("PostoptionsContainer");
        const PostfeedbackContainer = document.getElementById("PostfeedbackContainer");
        const PostcheckBtn = document.getElementById("PostcheckBtn");

        // Reset question and feedback
        PostquestionText.innerText = postTestQuestions[no_soal].question;
        PostoptionsContainer.innerHTML = '';
        PostfeedbackContainer.style.display = 'none'; // Hides feedback when loading a new question
        PostfeedbackContainer.innerHTML = ''; // Clears previous feedback content
        PostcheckBtn.innerText = 'Periksa';
        PostcheckBtn.disabled = false;

        postTestQuestions[no_soal].options.forEach((option, index) => {
            const optionLabel = document.createElement("label");
            const optionRadio = document.createElement("input");
            optionRadio.type = "radio";
            optionRadio.name = "option";
            optionRadio.value = index;
            optionLabel.appendChild(optionRadio);
            optionLabel.appendChild(document.createTextNode(option));
            PostoptionsContainer.appendChild(optionLabel);
            PostoptionsContainer.appendChild(document.createElement("br"));
        });
    }

    function PostcheckAnswer() {
        console.log('Cek Jawaban')

        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (!selectedOption) return;

        const feedbackContainer = document.getElementById("feedbackContainer");
        const checkBtn = document.getElementById("checkBtn");

        const selectedValue = parseInt(selectedOption.value);
        const correctValue = postTestQuestions[no_soal].correct;

        PostfeedbackContainer.style.display = 'block'; // Shows feedback after checking

        if (selectedValue === correctValue) {
            benarPostTest++;
            PostfeedbackContainer.className = 'feedback correct';
            PostfeedbackContainer.innerHTML = "✅ Jawaban benar! " + postTestQuestions[no_soal].explanation;
        } else {
            PostfeedbackContainer.className = 'feedback wrong';
            PostfeedbackContainer.innerHTML = "❌ Jawaban salah! " + postTestQuestions[no_soal].explanation;
        }

        PostcheckBtn.innerText = "Selanjutnya";
        PostcheckBtn.onclick = PostnextQuestion;
    }

    function PostnextQuestion() {
        no_soal++;
        if (no_soal < postTestQuestions.length) {
            PostloadQuestion();
            const PostcheckBtn = document.getElementById("PostcheckBtn");
            PostcheckBtn.onclick = PostcheckAnswer;
            PostcheckBtn.innerText = "Periksa";
        } else {
            // Tampilkan hasil akhir dengan SweetAlert
            Swal.fire({
                title: "Post-test selesai!",
                text: `Jumlah jawaban benar: ${benarPostTest} dari ${postTestQuestions.length}`,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                // Tindakan tambahan setelah menutup alert, jika diperlukan
                console.log("Post-test selesai, SweetAlert ditutup.");
                // Misalnya: Redirect, submit hasil, dsb.
                // Set nilai di form dan submit
                document.getElementById("nilaiAkhir2").value = benarPostTest*20;
                document.getElementById("postTestForm").submit();
            });
        }
    }

    PostloadQuestion();
</script>


@endsection