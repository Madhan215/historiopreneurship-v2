@extends('layouts.main')

@section('container-content')

{{-- Style Drag n Drop --}}
<link rel="stylesheet" href="{{asset('css/test.css')}}">



<h2>Kuis Kesejarahan</h2>
<div class="card mt-4">
    <div class="p-3 d-flex align-items-center card-header">
        <div class="mb-0 h5 fw-semibold card-title">
            <i class="bi bi-pencil"></i> Kuis: Drag n Drop 5 Objek Wisata di Kalimantan Selatan!
        </div>
    </div>
    <div class="p-4 card-body">
        <p class="fw-semibold">Panduan Pengerjaan:</p>
        <ol>
            <li>Pilih Gambar yang menurut Anda Benar</li>
            <li>Seret Gambar ke kotak Jawaban</li>
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


    <div class="soal" >
        <div class="jawaban" draggable="true" id="jawaban1" data-correct="true">
            <img src="{{asset('img/1.jpg')}}" alt="Gambar 1">
        </div>
        <div class="jawaban" draggable="true" id="jawaban2" data-correct="true">
            <img src="{{asset('img/2.jpg')}}" alt="Gambar 2">
        </div>
        <div class="jawaban" draggable="true" id="jawaban3" data-correct="true">
            <img src="{{asset('img/3.jpg')}}" alt="Gambar 3">
        </div>
        <div class="jawaban" draggable="true" id="jawaban4" data-correct="true">
            <img src="{{asset('img/4.jpg')}}" alt="Gambar 4">
        </div>
        <div class="jawaban" draggable="true" id="jawaban5" data-correct="true">
            <img src="{{asset('img/5.jpg')}}" alt="Gambar 5">
        </div>
        <div class="jawaban" draggable="true" id="jawaban6" data-correct="false">
            <img src="{{asset('img/6.jpg')}}" alt="Gambar 6">
        </div>
        <div class="jawaban" draggable="true" id="jawaban7" data-correct="false">
            <img src="{{asset('img/7.jpeg')}}" alt="Gambar 7">
        </div>
        <div class="jawaban" draggable="true" id="jawaban8" data-correct="false">
            <img src="{{asset('img/8.jpeg')}}" alt="Gambar 8">
        </div>
        <div class="jawaban" draggable="true" id="jawaban9" data-correct="false">
            <img src="{{asset('img/9.jpeg')}}" alt="Gambar 9">
        </div>
        <div class="jawaban" draggable="true" id="jawaban10" data-correct="false">
            <img src="{{asset('img/10.jpg')}}" alt="Gambar 10">
        </div>
    </div>
    
    <div class="kotakJawaban" id="kotakJawaban"></div>
    
    
    
    <!-- Historio dan non Historio -->
    
    
    <div class="text-center">
        <button id="submitBtn" class="btn btn-primary">Submit</button>
        <button id="resetBtn" class="btn btn-warning">Reset</button>
    </div>
    
    <!-- Modal untuk menampilkan nilai -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <h2>Hasil</h2>
            <p id="nilaiTotal" class="nilai-text">Total Nilai: 0</p>
            <form id="tutupForm" action="{{ route('DND1') }}" method="POST">
                @csrf
                <input type="hidden" id="nilaiAkhirInput" name="nilai_akhir">
                <input type="hidden" name="aspek" value="poin_DND_Kesejarahan">
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
<script src="{{asset('js/kuis1.js')}}"></script>

@endsection