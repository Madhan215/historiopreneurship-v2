@extends('layouts.main')

@section('container-content')

<h2>Pre Test B. Kesejarahan</h2>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="shadow bg-light rounded p-3" style="height: 50vh; overflow-y: auto;" id="question-container">
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
        
    <form id="preTestForm" action="{{ route('simpanNilaiPretest') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
        <!-- Ganti dengan email pengguna -->
        <input type="hidden" name="nilai_akhir" id="nilaiAkhir">
        <input type="hidden" name="lama_waktu_pengerjaan" id="lama_waktu_pengerjaan">
        <input type="hidden" name="aspek" value="pre_test_kesejarahan">
    </form>
</div>
<script>
    // Script Pre Test
    const questions = [
    {
        question: "Siapakah pendiri Kesultanan Banjar?",
        options: ["Sultan Adam", "Sultan Suriansyah", "Pangeran Antasari", "Pangeran Hidayatullah"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Perang Banjar terjadi pada tahun?",
        options: ["1860-1865", "1859-1905", "1845-1862", "1870-1885"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Siapa yang memimpin Perang Banjar setelah Pangeran Antasari?",
        options: ["Sultan Adam", "Pangeran Hidayatullah", "Pangeran Diponegoro", "Sultan Suriansyah"],
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
        question: "Pahlawan nasional dari Kalimantan Selatan adalah?",
        options: ["Pangeran Diponegoro", "Cut Nyak Dien", "Pangeran Antasari", "Sultan Hasanuddin"],
        correct: 2,
        explanation: ""
    },
    {
        question: "Apa dampak dari Perang Banjar terhadap masyarakat lokal?",
        options: ["Meningkatnya kesejahteraan", "Peningkatan pendidikan", "Kerugian ekonomi dan sosial", "Pembangunan infrastruktur"],
        correct: 2,
        explanation: ""
    },
    {
        question: "Mengapa Sultan Suriansyah memeluk Islam?",
        options: ["Untuk mendapatkan kekuasaan", "Pengaruh dari pedagang", "Untuk menyatukan rakyat", "Tekanan dari Belanda"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi motivasi utama Pangeran Antasari dalam memimpin Perang Banjar?",
        options: ["Mendapatkan kekayaan", "Mempertahankan tanah air", "Mendapatkan dukungan dari Belanda", "Mencari ketenaran"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa peran perempuan dalam Perang Banjar?",
        options: ["Tidak ada peran", "Sebagai pengumpul dana", "Sebagai pejuang", "Sebagai diplomat"],
        correct: 2,
        explanation: ""
    },
    {
        question: "Apa yang dapat dipelajari dari perjuangan Pangeran Antasari?",
        options: ["Kepentingan kekuasaan", "Nilai-nilai kepemimpinan dan keberanian", "Pentingnya aliansi dengan Belanda", "Kepentingan ekonomi"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Bagaimana cara Pangeran Hidayatullah melanjutkan perjuangan setelah Pangeran Antasari?",
        options: ["Dengan diplomasi", "Dengan strategi militer", "Dengan penggalangan massa", "Dengan perjanjian damai"],
        correct: 2,
        explanation: ""
    },
    {
        question: "Apa yang menjadi ciri khas budaya Banjar setelah Islam masuk?",
        options: ["Pengaruh Hindu yang kuat", "Tradisi lisan yang hilang", "Perkembangan seni dan sastra Islam", "Penutupan terhadap budaya lokal"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi tantangan utama Kesultanan Banjar dalam mempertahankan kemerdekaan?",
        options: ["Persaingan antar kerajaan", "Kekurangan sumber daya", "Intervensi kolonial Belanda", "Kurangnya dukungan rakyat"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang dapat dilakukan untuk melestarikan sejarah Perang Banjar?",
        options: ["Mengabaikan sejarah", "Mendokumentasikan dan mengajarkan kepada generasi muda", "Membuat film tentang Perang Banjar", "Menyembunyikan fakta sejarah"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi pengaruh Perang Banjar terhadap perkembangan politik di Indonesia?",
        options: ["Meningkatnya kekuasaan kolonial", "Berkurangnya kesadaran politik", "Munculnya gerakan nasionalisme", "Peningkatan kerjasama dengan Belanda"],
        correct: 2,
        explanation: ""
    },
    {
        question: "Siapa yang menjadi tokoh penting dalam diplomasi Kesultanan Banjar?",
        options: ["Sultan Adam", "Pangeran Antasari", "Pangeran Hidayatullah", "Sultan Suriansyah"],
        correct: 0,
        explanation: ""
    },
    {
        question: "Apa yang menjadi strategi utama dalam Perang Banjar?",
        options: ["Perang terbuka", "Perang gerilya", "Perang diplomasi", "Perang ekonomi"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi warisan budaya dari Kesultanan Banjar?",
        options: ["Seni tari", "Seni lukis", "Seni musik", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Bagaimana cara masyarakat Banjar merayakan hari kemerdekaan?",
        options: ["Dengan upacara resmi", "Dengan festival budaya", "Dengan demonstrasi", "Dengan perayaan sederhana"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi peran penting pendidikan dalam masyarakat Banjar?",
        options: ["Meningkatkan kesadaran sejarah", "Meningkatkan keterampilan ekonomi", "Meningkatkan kesadaran politik", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi tantangan dalam pelestarian budaya Banjar?",
        options: ["Globalisasi", "Kurangnya minat generasi muda", "Keterbatasan sumber daya", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi kontribusi Kesultanan Banjar terhadap Indonesia?",
        options: ["Peningkatan perdagangan", "Peningkatan pendidikan", "Perjuangan melawan penjajahan", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi simbol perjuangan rakyat Banjar?",
        options: ["Bendera Kesultanan", "Lambang Pahlawan", "Lagu perjuangan", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi harapan masyarakat Banjar untuk masa depan?",
        options: ["Kemandirian ekonomi", "Pelestarian budaya", "Pendidikan yang lebih baik", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    },
    {
        question: "Apa yang menjadi peran penting pemuda dalam sejarah Banjar?",
        options: ["Sebagai pengikut", "Sebagai pemimpin perubahan", "Sebagai penonton", "Sebagai pengacau"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi nilai-nilai yang diajarkan dalam sejarah Perang Banjar?",
        options: ["Keberanian dan pengorbanan", "Kekuasaan dan kekayaan", "Kepentingan pribadi", "Semua jawaban salah"],
        correct: 0,
        explanation: ""
    },
    {
        question: "Apa yang menjadi faktor utama yang memicu Perang Banjar?",
        options: ["Pajak yang tinggi", "Kekuasaan lokal", "Perbedaan agama", "Intervensi asing"],
        correct: 0,
        explanation: ""
    },
    {
        question: "Bagaimana pengaruh Perang Banjar terhadap identitas masyarakat Banjar?",
        options: ["Menghilangkan identitas lokal", "Memperkuat identitas budaya", "Mendorong asimilasi", "Tidak ada pengaruh"],
        correct: 1,
        explanation: ""
    },
    {
        question: "Apa yang menjadi peran penting sejarah dalam pendidikan masyarakat Banjar?",
        options: ["Membentuk karakter", "Meningkatkan keterampilan teknis", "Mendorong persaingan", "Mengabaikan nilai-nilai lokal"],
        correct: 0,
        explanation: ""
    },
    {
        question: "Apa yang menjadi harapan masyarakat Banjar terhadap generasi muda?",
        options: ["Menjaga tradisi", "Meningkatkan pengetahuan", "Berpartisipasi dalam pembangunan", "Semua jawaban benar"],
        correct: 3,
        explanation: ""
    }
];


    let namaTest = "Pre Test B";
    let currentQuestion = 0;
    let correctCount = 0;
</script>

@endsection