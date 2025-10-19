@extends('layouts.home')

@section('container-kuis')
    <div class="fade show d-flex align-items-center justify-content-center vh-100">

        <div class="container py-4">
            <h2>{{ $judul }}</h2>
            <p><strong>Topik:</strong> {{ $topik }}</p>
            <hr>

            @php
                $soals = json_decode($konten, true);
                $jumlahSoal = is_array($soals) ? count($soals) : 0;
            @endphp

            <div class="shadow bg-light rounded p-3" style="height: 50vh; overflow-y: auto;" id="question-container">
                {{-- SOAL TEST --}}
                <div id="soal-test" hidden>
                    <!-- Timer -->
                    <div class="progress mb-3">
                        <div id="status_bar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
                    </div>
                    <div class="row position-relative">
                        <div class="col-1 position-absolute top-0 end-0" id="timer">
                            <span id="timerText">30:00</span>
                        </div>
                        <div class="col-11">
                            <div class="question mb-3" id="questionText"></div>
                            <div class="options mb-3 ms-2 form-check" id="optionsContainer"></div>
                            <div class="feedback mt-2" id="feedbackContainer" style="display:none;"></div>
                            <button class="btn btn-success mt-3" id="checkBtn" onclick="checkAnswer()">Periksa</button>
                        </div>
                    </div>
                </div>

                {{-- INFO TEST --}}
                <div id="info-test">
                    <p class="text-center"><b>Keterangan Soal</b></p>
                    <p class="text-center"><b>Jumlah Soal : </b>{{ $jumlahSoal }}</p>
                    <p class="text-center"><b>Durasi Pengerjaan : </b>30 Menit</p>
                    <p class="text-center"><b>Batas Percobaan : </b>
                        <span id="batas_test">{{ $batas_test_value ?? '-' }}</span>
                    </p>
                    <div class="text-center">
                        <h5>NILAI</h5>
                        <div id="skor_test" class="h1 text-primary">{{ $skor_test_value ?? '-' }}</div>
                    </div>
                    <p class="text-sm text-center" id="mulai_waktu">Waktu akan dimulai saat anda menekan tombol mulai</p>
                    <div class="text-center">
                        <button class="btn btn-primary me-2" id="mulai_test" onclick="mulai()" {{ !$bisaMengerjakan ? 'disabled' : '' }}>
                            Mulai
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">KEMBALI</a>
                    </div>

                    @if (!$bisaMengerjakan)
                        <p class="text-danger text-center mt-3">
                            Anda telah mencapai batas maksimum percobaan 3 kali.
                        </p>
                    @endif
                </div>

            </div>

            {{-- 🔹 Navigasi Prev/Next --}}
            <div class="d-flex justify-content-between mt-4">
                @if($prevUrl)
                    <a href="{{ $prevUrl }}" class="btn btn-outline-primary">&laquo; Sebelumnya</a>
                @else
                    <div></div>
                @endif

                @if($nextUrl)
                    <a href="{{ $nextUrl }}" class="btn btn-primary">Selanjutnya &raquo;</a>
                @endif
            </div>

            {{-- Form hidden --}}
            <form id="preTestForm" action="{{ route('SimpanNilaiEvaluasi') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                <input type="hidden" name="nilai_akhir" id="nilaiAkhir">
                <input type="hidden" name="lama_waktu_pengerjaan" id="lama_waktu_pengerjaan">
                <input type="hidden" name="aspek" value="{{ $judul }}">
            </form>
        </div>
    </div>

    <script>
        let namaTest = "{{ $judul }}";
        let currentQuestion = 0;
        let correctCount = 0;
        let questions = @json($soals);
        const totalQuestions = {{ $jumlahSoal }};
    </script>
@endsection