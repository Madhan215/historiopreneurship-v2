@extends('layouts.main')

@section('container-content')
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
                <div class="row position-relative">
                    <!-- Timer -->
                    <div class="col-1 position-absolute top-0 end-0" id="timer">
                        <span id="timerText">30:00</span>
                    </div>
                    <div class="progress mb-3">
                        <div id="status_bar" class="progress-bar" role="progressbar" style="width: 0%">
                            0%
                        </div>
                    </div>


                    <!-- Soal -->
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
                <p class="text-center"><b>Keterangan Test</b></p>
                <p class="text-center"><b>Jumlah Soal : </b>{{ $jumlahSoal }}</p>
                <p class="text-center"><b>Durasi Pengerjaan : </b>30 Menit</p>
                <p class="text-center"><b>Batas test : </b><span id="batas_test">{{ $batas_test_value ?? '-' }}</span></p>
                <p class="text-center"><b>Skor Anda : </b><span id="skor_test">{{ $skor_test_value ?? '-' }}</span></p>
                <p class="text-sm text-center">Waktu akan dimulai saat anda menekan tombol mulai</p>
                <div class="text-center">
                    <button class="btn btn-primary" id="mulai_test" onclick="mulai()">Mulai</button>
                </div>
            </div>
        </div>

        <form id="preTestForm" action="{{ route('SimpanNilaiEvaluasi') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="nilai_akhir" id="nilaiAkhir">
            <input type="hidden" name="lama_waktu_pengerjaan" id="lama_waktu_pengerjaan">
            <input type="hidden" name="aspek" value="pre_test_kesejarahan">
        </form>
    </div>

    <script>
        let namaTest = "Pre Test B";
        let currentQuestion = 0;
        let correctCount = 0;
        let questions = @json($soals);
    </script>
@endsection