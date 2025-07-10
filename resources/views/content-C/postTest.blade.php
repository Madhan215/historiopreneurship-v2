@extends('layouts.main')

@section('container-content')

<h2>Post Test C. KWU dan Kepariwisataan</h2>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="shadow bg-light rounded p-3" style="height: 50vh; ; overflow-y: auto;" id="question-container">
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
        <input type="hidden" name="aspek" value="post_test_kwu">
    </form>

</div>
<script>
    // Script Pre Test
    const questions = [
        {
            question: "Apa yang dimaksud dengan pattern identification dalam kewirausahaan?",
            options: ["Mengidentifikasi sumber dana", "Mengidentifikasi pola dalam pasar atau industri", "Menghitung keuntungan", "Mencari supplier terbaik"],
            correct: 1,
            explanation: "Mengidentifikasi pola dalam pasar atau industri"
        },
        {
            question: "Tujuan utama dari pattern identification adalah untuk...",
            options: ["Menciptakan persaingan baru", "Menemukan peluang bisnis yang belum dimanfaatkan", "Menjaga stabilitas keuangan perusahaan", "Mengurangi biaya operasional"],
            correct: 1,
            explanation: "Menemukan peluang bisnis yang belum dimanfaatkan"
        },
        {
            question: "Yang bukan merupakan pola yang sering diidentifikasi dalam pattern identification adalah...",
            options: ["Tren konsumen", "Perubahan regulasi", "Kondisi pasar", "Jenis pakaian manajer"],
            correct: 3,
            explanation: "Jenis pakaian manajer"
        },
        {
            question: "Apa yang dimaksud dengan bauran pemasaran?",
            options: [
                "Kombinasi strategi untuk mengembangkan produk",
                "Rencana jangka panjang untuk meningkatkan profit",
                "Serangkaian tindakan untuk memengaruhi pelanggan",
                "Kombinasi elemen-elemen pemasaran yang digunakan untuk mencapai tujuan pasar"
            ],
            correct: 3,
            explanation: "Kombinasi elemen-elemen pemasaran yang digunakan untuk mencapai tujuan pasar"
        },
        {
            question: "Elemen utama dalam konsep bauran pemasaran adalah ...",
            options: [
                "Harga, promosi, tempat, dan produk",
                "Produk, harga, tempat, dan pasar",
                "Promosi, produk, strategi, dan tempat",
                "Produk, distribusi, layanan, dan harga"
            ],
            correct: 0,
            explanation: "Harga, promosi, tempat, dan produk"
        },
        {
            question: "Dalam konsep 4P, elemen \"Product\" mengacu pada ...",
            options: [
                "Harga yang ditawarkan kepada pelanggan",
                "Fasilitas promosi yang diberikan",
                "Barang atau jasa yang ditawarkan kepada pasar",
                "Lokasi tempat produk dijual"
            ],
            correct: 2,
            explanation: "Barang atau jasa yang ditawarkan kepada pasar"
        },
        {
            question: "Strategi promosi yang baik bertujuan untuk ...",
            options: [
                "Meningkatkan harga produk",
                "Menarik minat pelanggan",
                "Mengurangi distribusi produk",
                "Meningkatkan biaya pemasaran"
            ],
            correct: 1,
            explanation: "Menarik minat pelanggan"
        },
        {
            question: "Elemen bauran pemasaran tambahan pada 7P adalah ...",
            options: [
                "People, Process, Physical Evidence",
                "Partnership, Planning, Pricing",
                "Positioning, Price, Promotion",
                "Physical Product, People, Place"
            ],
            correct: 0,
            explanation: "People, Process, Physical Evidence"
        },
        {
            question: "Yang termasuk dalam elemen 4P adalah ...",
            options: [
                "People",
                "Price",
                "Process",
                "Physical Evidence"
            ],
            correct: 1,
            explanation: "Price"
        },
        {
            question: "Faktor People dalam 7P mengacu pada ...",
            options: [
                "Harga produk",
                "Orang-orang yang terlibat dalam layanan",
                "Saluran distribusi produk",
                "Proses pembuatan produk"
            ],
            correct: 1,
            explanation: "Orang-orang yang terlibat dalam layanan"
        },
        {
            question: "Apa tujuan utama dari bauran pemasaran?",
            options: [
                "Mengurangi biaya produksi",
                "Meningkatkan penjualan dan kepuasan pelanggan",
                "Menambah produk pesaing",
                "Mengurangi promosi"
            ],
            correct: 1,
            explanation: "Meningkatkan penjualan dan kepuasan pelanggan"
        },
        {
            question: "Manakah yang termasuk elemen-elemen dasar dalam konsep bauran pemasaran?",
            options: [
                "Analisis kompetitor",
                "Produk, harga, tempat, dan promosi",
                "Branding, harga, dan distribusi",
                "Iklan, distribusi, dan harga"
            ],
            correct: 1,
            explanation: "Produk, harga, tempat, dan promosi"
        },
        {
            question: "Dalam bauran pemasaran, elemen \"Harga\" digunakan untuk ...",
            options: [
                "Mengidentifikasi pesaing",
                "Mengatur penetapan biaya produk untuk pelanggan",
                "Menentukan lokasi distribusi",
                "Meningkatkan kualitas produk"
            ],
            correct: 1,
            explanation: "Mengatur penetapan biaya produk untuk pelanggan"
        },
        {
            question: "Promosi bertujuan untuk ...",
            options: [
                "Meningkatkan distribusi produk",
                "Menambah biaya produksi",
                "Menginformasikan, membujuk, dan mengingatkan pelanggan tentang produk",
                "Mengubah proses layanan"
            ],
            correct: 2,
            explanation: "Menginformasikan, membujuk, dan mengingatkan pelanggan tentang produk"
        },
        {
            question: "Elemen dalam 7P yang tidak ada dalam 4P adalah ...",
            options: [
                "Produk",
                "Promosi",
                "Orang-orang (People)",
                "Tempat"
            ],
            correct: 2,
            explanation: "Orang-orang (People)"
        },
        {
            question: "Physical Evidence dalam pemasaran jasa dapat berupa ...",
            options: [
                "Harga produk",
                "Kemasan produk",
                "Bukti fisik seperti fasilitas atau suasana tempat",
                "Jaringan distribusi"
            ],
            correct: 2,
            explanation: "Bukti fisik seperti fasilitas atau suasana tempat"
        },
        {
            question: "Dalam mengembangkan produk baru, perusahaan harus memahami kebutuhan pasar. Langkah pertama yang paling penting adalah...",
            options: [
                "Menentukan harga produk",
                "Melakukan riset pasar untuk memahami kebutuhan pelanggan",
                "Meluncurkan produk dengan fitur terbaru",
                "Mengandalkan strategi promosi besar-besaran"
            ],
            correct: 1,
            explanation: "Melakukan riset pasar untuk memahami kebutuhan pelanggan"
        },
        {
            question: "Perusahaan X membuat varian produk yang lebih murah namun tetap menjaga kualitas dasar produk. Strategi ini bertujuan untuk...",
            options: [
                "Memenuhi permintaan pasar premium",
                "Meningkatkan keuntungan dengan margin tinggi",
                "Mencapai segmen pasar yang lebih luas",
                "Membangun citra merek yang mewah"
            ],
            correct: 2,
            explanation: "Mencapai segmen pasar yang lebih luas"
        },
        {
            question: "Dalam siklus hidup produk, pada tahap apa perusahaan umumnya fokus untuk meningkatkan kesadaran merek dan menarik konsumen baru?",
            options: [
                "Perkenalan",
                "Pertumbuhan",
                "Kedewasaan",
                "Penurunan"
            ],
            correct: 0,
            explanation: "Perkenalan"
        },
        {
            question: "Bagaimana sebuah perusahaan dapat mempertahankan produk di tahap kedewasaan dalam siklus hidup produk?",
            options: [
                "Mengurangi anggaran promosi",
                "Menurunkan kualitas produk",
                "Melakukan inovasi atau pengembangan fitur produk",
                "Mengabaikan umpan balik pelanggan"
            ],
            correct: 2,
            explanation: "Melakukan inovasi atau pengembangan fitur produk"
        },
        {
            question: "Ketika perusahaan menambah fitur tambahan pada produk untuk menarik minat konsumen, mereka sedang melakukan...",
            options: [
                "Penyesuaian harga",
                "Promosi besar-besaran",
                "Pengembangan produk",
                "Pengurangan biaya produksi"
            ],
            correct: 2,
            explanation: "Pengembangan produk"
        },
        {
            question: "Mengapa penting bagi perusahaan jasa untuk memiliki alur proses layanan yang jelas dan terstandarisasi?",
            options: [
                "Untuk mempersingkat waktu layanan",
                "Untuk memberikan pengalaman pelanggan yang konsisten dan meningkatkan kepercayaan pelanggan",
                "Untuk mengurangi jumlah pelanggan yang dilayani",
                "Untuk menambah biaya layanan"
            ],
            correct: 1,
            explanation: "Untuk memberikan pengalaman pelanggan yang konsisten dan meningkatkan kepercayaan pelanggan"
        },
        {
            question: "Saat perusahaan jasa menerapkan proses layanan yang transparan, dampak utamanya bagi pelanggan adalah...",
            options: [
                "Mengurangi ekspektasi terhadap layanan",
                "Meningkatkan pemahaman pelanggan atas tahapan layanan, yang meningkatkan kepercayaan mereka",
                "Membatasi pengalaman layanan",
                "Mengurangi kualitas layanan"
            ],
            correct: 1,
            explanation: "Meningkatkan pemahaman pelanggan atas tahapan layanan, yang meningkatkan kepercayaan mereka"
        },
        {
            question: "Apa keuntungan utama dari penerapan teknologi dalam proses penyediaan layanan jasa?",
            options: [
                "Meningkatkan biaya layanan",
                "Mengurangi jumlah pelanggan yang dilayani",
                "Meningkatkan efisiensi dan mempercepat proses layanan tanpa mengurangi kualitas",
                "Membatasi akses pelanggan ke layanan"
            ],
            correct: 2,
            explanation: "Meningkatkan efisiensi dan mempercepat proses layanan tanpa mengurangi kualitas"
        },
        {
            question: "Jika proses layanan yang diterapkan perusahaan jasa rumit dan tidak efisien, kemungkinan dampak utamanya adalah...",
            options: [
                "Meningkatkan loyalitas pelanggan",
                "Menurunkan kepuasan pelanggan karena waktu tunggu yang lama dan pengalaman yang tidak menyenangkan",
                "Meningkatkan jumlah pelanggan",
                "Menurunkan biaya pelatihan karyawan"
            ],
            correct: 1,
            explanation: "Menurunkan kepuasan pelanggan karena waktu tunggu yang lama dan pengalaman yang tidak menyenangkan"
        },
        {
            question: "Jika perusahaan ingin meningkatkan citra merek, elemen bauran pemasaran yang perlu difokuskan adalah ...",
            options: [
                "Produk",
                "Harga",
                "Promosi",
                "Tempat"
            ],
            correct: 2,
            explanation: "Promosi"
        },
        {
            question: "Mengapa proses pelayanan penting dalam pemasaran jasa?",
            options: [
                "Meningkatkan keuntungan secara langsung",
                "Mengurangi waktu produksi",
                "Membantu menjaga konsistensi layanan dan meningkatkan kepuasan pelanggan",
                "Meningkatkan harga produk"
            ],
            correct: 2,
            explanation: "Membantu menjaga konsistensi layanan dan meningkatkan kepuasan pelanggan"
        },
        {
            question: "Dalam bisnis jasa, 'Physical Evidence' membantu untuk ...",
            options: [
                "Menurunkan harga produk",
                "Memberikan bukti kualitas layanan kepada pelanggan",
                "Mengurangi biaya promosi",
                "Memperluas jaringan distribusi"
            ],
            correct: 1,
            explanation: "Memberikan bukti kualitas layanan kepada pelanggan"
        },
        {
            question: "Elemen yang berperan besar dalam menarik pelanggan baru melalui penawaran dan kampanye adalah ...",
            options: [
                "People",
                "Place",
                "Promotion",
                "Physical Evidence"
            ],
            correct: 2,
            explanation: "Promotion"
        },
        {
            question: "Jika sebuah produk diiklankan di berbagai media sosial, elemen yang dioptimalkan adalah ...",
            options: [
                "Place",
                "Promotion",
                "Process",
                "Price"
            ],
            correct: 1,
            explanation: "Promotion"
        }
    ];

    

    let namaTest = "Post Test C";
    let currentQuestion = 0;
    let correctCount = 0;

    
</script>


@endsection