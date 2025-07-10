@extends('layouts.main')

@section('container-content')

<h2>Post Test B. Kesejarahan</h2>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="shadow bg-light rounded p-3" style="height: 50vh;  overflow-y: auto;" id="question-container">
    <div id="soal-test" hidden>
        <div class="row position-relative">
        <!-- Timer Column (Right top corner) -->
        <div class="col-1 position-absolute top-0 end-0" id="timer">
            <span id="timerText">30:00</span>
        </div>

        <!-- Soal Content Column -->
        <div class="col-11">
                <div class="question mb-3" id="questionText"></div>
                <div class="options mb-3 ms-2 form-check" id="optionsContainer"></div>
                <div class="feedback" id="feedbackContainer"></div>
                <button class="btn btn-success mt-3" id="checkBtn" onclick="checkAnswer()">Periksa</button>
            </div>
        </div>
    </div>

    <div id="info-test">
        <p class="text-center"><b>Keterangan Test</b></p>
        <p class="text-center"><b>Jumlah Soal : </b>30</p>
        <p class="text-center"><b>Durasi Pengerjaan : </b>30 Menit</p>
        <p class="text-center"><b>Batas test : </b><span id="batas_test">{{$batas_test_value}}</span></p>
        <p class="text-center"><b>Skor Anda : </b><span id="skor_test">{{$skor_test_value}}</span></p>
        <p class="text-sm text-center">Waktu akan dimulai saat anda menekan tombol mulai</p>
        <div class="text-center">
            <button class="btn btn-primary" onclick="mulai()" id="mulai_test">Mulai</button>
        </div>
    </div>
        
    <form id="preTestForm" action="{{ route('simpanNilaiPosttest') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
        <!-- Ganti dengan email pengguna -->
        <input type="hidden" name="nilai_akhir" id="nilaiAkhir">
        <input type="hidden" name="lama_waktu_pengerjaan" id="lama_waktu_pengerjaan">
        <input type="hidden" name="aspek" value="post_test_kesejarahan">
    </form>
    
</div>
<script>
    // Script Pre Test
    const questions = [
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
    },
    {
        question: "Apa dampak dari Perang Banjar terhadap masyarakat lokal?",
        options: ["Meningkatnya kesejahteraan", "Peningkatan pendidikan", "Kerugian ekonomi dan sosial", "Pembangunan infrastruktur"],
        correct: 2,
        explanation: "Perang Banjar menyebabkan kerugian ekonomi dan sosial yang signifikan bagi masyarakat lokal."
    },
    {
        question: "Mengapa Sultan Suriansyah memeluk Islam?",
        options: ["Untuk mendapatkan kekuasaan", "Pengaruh dari pedagang", "Untuk menyatukan rakyat", "Tekanan dari Belanda"],
        correct: 1,
        explanation: "Sultan Suriansyah memeluk Islam karena pengaruh dari pedagang yang datang ke wilayah tersebut."
    },
    {
        question: "Apa yang menjadi motivasi utama Pangeran Antasari dalam memimpin Perang Banjar?",
        options: ["Mendapatkan kekayaan", "Mempertahankan tanah air", "Mendapatkan dukungan dari Belanda", "Mencari ketenaran"],
        correct: 1,
        explanation: "Motivasi utama Pangeran Antasari adalah mempertahankan tanah air dari penjajahan Belanda."
    },
    {
        question: "Apa peran perempuan dalam Perang Banjar?",
        options: ["Tidak ada peran", "Sebagai pengumpul dana", "Sebagai pejuang", "Sebagai diplomat"],
        correct: 2,
        explanation: "Perempuan juga berperan sebagai pejuang dalam Perang Banjar, mendukung perjuangan para pahlawan."
    },
    {
        question: "Apa yang dapat dipelajari dari perjuangan Pangeran Antasari?",
        options: ["Kepentingan kekuasaan", "Nilai-nilai kepemimpinan dan keberanian", "Pentingnya aliansi dengan Belanda", "Kepentingan ekonomi"],
        correct: 1,
        explanation: "Perjuangan Pangeran Antasari mengajarkan nilai-nilai kepemimpinan dan keberanian dalam melawan penjajahan."
    },
    {
        question: "Bagaimana cara Pangeran Hidayatullah melanjutkan perjuangan setelah Pangeran Antasari?",
        options: ["Dengan diplomasi", "Dengan strategi militer", "Dengan penggalangan massa", "Dengan perjanjian damai"],
        correct: 2,
        explanation: "Pangeran Hidayatullah melanjutkan perjuangan dengan strategi militer yang lebih terorganisir."
    },
    {
        question: "Apa yang menjadi ciri khas budaya Banjar setelah Islam masuk?",
        options: ["Pengaruh Hindu yang kuat", "Tradisi lisan yang hilang", "Perkembangan seni dan sastra Islam", "Penutupan terhadap budaya lokal"],
        correct: 3,
        explanation: "Setelah Islam masuk, terjadi perkembangan seni dan sastra Islam yang menjadi ciri khas budaya Banjar."
    },
    {
        question: "Apa yang menjadi tantangan utama Kesultanan Banjar dalam mempertahankan kemerdekaan?",
        options: ["Persaingan antar kerajaan", "Kekurangan sumber daya", "Intervensi kolonial Belanda", "Kurangnya dukungan rakyat"],
        correct: 3,
        explanation: "Intervensi kolonial Belanda menjadi tantangan utama bagi Kesultanan Banjar dalam mempertahankan kemerdekaan."
    },
    {
        question: "Apa yang dapat dilakukan untuk melestarikan sejarah Perang Banjar?",
        options: ["Mengabaikan sejarah", "Mendokumentasikan dan mengajarkan kepada generasi muda", "Membuat film tentang Perang Banjar", "Menyembunyikan fakta sejarah"],
        correct: 1,
        explanation: "Mendokumentasikan dan mengajarkan sejarah Perang Banjar kepada generasi muda sangat penting untuk pelestarian."
    },
    {
        question: "Apa yang menjadi pengaruh Perang Banjar terhadap perkembangan politik di Indonesia?",
        options: ["Meningkatnya kekuasaan kolonial", "Berkurangnya kesadaran politik", "Munculnya gerakan nasionalisme", "Peningkatan kerjasama dengan Belanda"],
        correct: 2,
        explanation: "Perang Banjar memicu munculnya gerakan nasionalisme di Indonesia sebagai reaksi terhadap penjajahan."
    },
    {
        question: "Siapa yang menjadi tokoh penting dalam diplomasi Kesultanan Banjar?",
        options: ["Sultan Adam", "Pangeran Antasari", "Pangeran Hidayatullah", "Sultan Suriansyah"],
        correct: 0,
        explanation: "Sultan Adam dikenal sebagai tokoh penting dalam diplomasi Kesultanan Banjar."
    },
    {
        question: "Apa yang menjadi strategi utama dalam Perang Banjar?",
        options: ["Perang terbuka", "Perang gerilya", "Perang diplomasi", "Perang ekonomi"],
        correct: 1,
        explanation: "Strategi utama dalam Perang Banjar adalah perang gerilya untuk melawan kekuatan Belanda."
    },
    {
        question: "Apa yang menjadi warisan budaya dari Kesultanan Banjar?",
        options: ["Seni tari", "Seni lukis", "Seni musik", "Semua jawaban benar"],
        correct: 3,
        explanation: "Kesultanan Banjar meninggalkan warisan budaya yang kaya dalam seni tari, lukis, dan musik."
    },
    {
        question: "Bagaimana cara masyarakat Banjar merayakan hari kemerdekaan?",
        options: ["Dengan upacara resmi", "Dengan festival budaya", "Dengan demonstrasi", "Dengan perayaan sederhana"],
        correct: 1,
        explanation: "Masyarakat Banjar merayakan hari kemerdekaan dengan festival budaya yang melibatkan berbagai pertunjukan."
    },
    {
        question: "Apa yang menjadi peran penting pendidikan dalam masyarakat Banjar?",
        options: ["Meningkatkan kesadaran sejarah", "Meningkatkan keterampilan ekonomi", "Meningkatkan kesadaran politik", "Semua jawaban benar"],
        correct: 3,
        explanation: "Pendidikan berperan penting dalam meningkatkan kesadaran sejarah, keterampilan ekonomi, dan kesadaran politik masyarakat Banjar."
    },
    {
        question: "Apa yang menjadi tantangan dalam pelestarian budaya Banjar?",
        options: ["Globalisasi", "Kurangnya minat generasi muda", "Keterbatasan sumber daya", "Semua jawaban benar"],
        correct: 3,
        explanation: "Globalisasi dan kurangnya minat generasi muda menjadi tantangan dalam pelestarian budaya Banjar."
    },
    {
        question: "Apa yang menjadi kontribusi Kesultanan Banjar terhadap Indonesia?",
        options: ["Peningkatan perdagangan", "Peningkatan pendidikan", "Perjuangan melawan penjajahan", "Semua jawaban benar"],
        correct: 3,
        explanation: "Kesultanan Banjar memberikan kontribusi besar terhadap Indonesia dalam berbagai aspek, termasuk perjuangan melawan penjajahan."
    },
    {
        question: "Apa yang menjadi simbol perjuangan rakyat Banjar?",
        options: ["Bendera Kesultanan", "Lambang Pahlawan", "Lagu perjuangan", "Semua jawaban benar"],
        correct: 3,
        explanation: "Semua simbol tersebut menjadi representasi perjuangan rakyat Banjar dalam melawan penjajahan."
    },
    {
        question: "Apa yang menjadi harapan masyarakat Banjar untuk masa depan?",
        options: ["Kemandirian ekonomi", "Pelestarian budaya", "Pendidikan yang lebih baik", "Semua jawaban benar"],
        correct: 3,
        explanation: "Masyarakat Banjar berharap untuk mencapai kemandirian ekonomi, pelestarian budaya, dan pendidikan yang lebih baik."
    },
    {
        question: "Apa yang menjadi peran penting pemuda dalam sejarah Banjar?",
        options: ["Sebagai pengikut", "Sebagai pemimpin perubahan", "Sebagai penonton", "Sebagai pengacau"],
        correct: 1,
        explanation: "Pemuda memiliki peran penting sebagai pemimpin perubahan dalam sejarah Banjar."
    },
    {
        question: "Apa yang menjadi nilai-nilai yang diajarkan dalam sejarah Perang Banjar?",
        options: ["Keberanian dan pengorbanan", "Kekuasaan dan kekayaan", "Kepentingan pribadi", "Semua jawaban salah"],
        correct: 0,
        explanation: "Sejarah Perang Banjar mengajarkan nilai-nilai keberanian dan pengorbanan untuk tanah air."
    },
    {
        question: "Apa yang menjadi faktor utama yang memicu Perang Banjar?",
        options: ["Pajak yang tinggi", "Kekuasaan lokal", "Perbedaan agama", "Intervensi asing"],
        correct: 0,
        explanation: "Pajak yang tinggi yang dikenakan oleh pemerintah kolonial Belanda menjadi faktor utama yang memicu Perang Banjar."
    },
    {
        question: "Bagaimana pengaruh Perang Banjar terhadap identitas masyarakat Banjar?",
        options: ["Menghilangkan identitas lokal", "Memperkuat identitas budaya", "Mendorong asimilasi", "Tidak ada pengaruh"],
        correct: 1,
        explanation: "Perang Banjar memperkuat identitas budaya masyarakat Banjar sebagai bagian dari perjuangan melawan penjajahan."
    },
    {
        question: "Apa yang menjadi peran penting sejarah dalam pendidikan masyarakat Banjar?",
        options: ["Membentuk karakter", "Meningkatkan keterampilan teknis", "Mendorong persaingan", "Mengabaikan nilai-nilai lokal"],
        correct: 0,
        explanation: "Sejarah berperan penting dalam membentuk karakter masyarakat Banjar dan menanamkan nilai-nilai perjuangan."
    },
    {
        question: "Apa yang menjadi harapan masyarakat Banjar terhadap generasi muda?",
        options: ["Menjaga tradisi", "Meningkatkan pengetahuan", "Berpartisipasi dalam pembangunan", "Semua jawaban benar"],
        correct: 3,
        explanation: "Masyarakat Banjar berharap generasi muda dapat menjaga tradisi, meningkatkan pengetahuan, dan berpartisipasi dalam pembangunan."
    }
];


    let namaTest = "Post Test B";
    let currentQuestion = 0;
    let correctCount = 0;
</script>

@endsection