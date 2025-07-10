@extends('layouts.main')

@section('container-content')

<link rel="stylesheet" href="{{asset('css/test.css')}}">

<h2>Kuis KWU dan Kepariwisataan</h2>
<div class="card mt-4">
    <div class="p-3 d-flex align-items-center card-header">
        <div class="mb-0 h5 fw-semibold card-title">
            <i class="bi bi-pencil"></i> Kuis: Kelompokkan Objek Historio dan Non-Historio!
        </div>
            </div>
    <div class="p-4 card-body">
        <p class="fw-semibold">Panduan Pengerjaan:</p>
        <ol>
            <li>Pilih Gambar yang menurut Anda Benar</li>
            <li>Seret Gambar ke kotak Jawaban</li>
            <li>Letakkan gambar historio disebelah kanan dan non historio disebelah kiri</li>
            <li>Untuk Mengganti Jawaban seret kembali gambar ke atas kotak soal</li>
            <li>Tekan Submit ketika jawaban sudah dirasa benar</li>
            <li>Tekan Reset ketika Anda ingin mengulang </li>
        </ol>
        <p class="fw-semibold">Keterangan:</p>
        <ul>
            <li>Batas pengerjaan kuis hanya satu kali</li>
            <li>Status : <span class="fw-bold">{{ $batas_test_value == 0 ? 'Sudah dikerjakan' : 'Belum dikerjakan' }}</span></li>
            <li>Skor Kuis : <span class="fw-bold">{{$skor_test_value}}</span></li>
        </ul>
    </div>
</div>
<div {{ $batas_test_value == 0 ? 'hidden' : '' }}>
<div class="soal2">
    <div class="jawaban2" draggable="true" id="jawaban11" data-category="historio">
        <img src="{{asset('img/MasjidSultanSuriansyah.jpg')}}" alt="Masjid Sultan Suriansyah">
        </div>
    <div class="jawaban2" draggable="true" id="jawaban12" data-category="non-historio">
        <img src="{{asset('img/bajuin.jpg')}}" alt="Air Terjun Bajuin">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban13" data-category="historio">
        <img src="{{asset('img/wasaka.jpg')}}" alt="Museum Wasaka">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban14" data-category="non-historio">
        <img src="{{asset('img/danauSeran.jpeg')}}" alt="Danau Seran">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban15" data-category="historio">
        <img src="{{asset('img/CandiAgung.jpg')}}" alt="Candi Agung">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban16" data-category="historio">
        <img src="{{asset('img/pulauKembang.jpg')}}" alt="Pulau Kembang">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban17" data-category="non-historio">
        <img src="{{asset('img/bukitBirah.jpg')}}" alt="Bukit Birah">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban18" data-category="historio">
        <img src="{{asset('img/makamPangeranAntasari.jpg')}}" alt="Makam Pangeran Antasari">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban19" data-category="non-historio">
        <img src="{{asset('img/loksado.jpg')}}" alt="Loksado">
    </div>
    <div class="jawaban2" draggable="true" id="jawaban20" data-category="non-historio">
        <img src="{{asset('img/pantaiAngsana.jpg')}}" alt="Pantai Angsana">
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
                <form id="tutupForm" action="{{ route('DND2') }}" method="POST">
                    @csrf
                    <input type="hidden" id="nilaiAkhirInput" name="nilai_akhir">
                    <input type="hidden" name="aspek" value="poin_DND_KWU">
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

</div>

<script src="{{asset('js/test.js')}}"></script>
<script src="{{asset('js/kuis2.js')}}"></script>

@endsection