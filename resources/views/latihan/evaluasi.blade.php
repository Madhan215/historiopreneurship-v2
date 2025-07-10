@extends('layouts.main')

@section('container')



<?php

$_SESSION['data_soal'] = json_decode($soal->data_soal, true);
// dd($_SESSION['data_soal']);

// $data_soal = $_SESSION['data_soal'];
$data_dari_json = json_encode($soal->data_soal);
$soal_sekarang = $_SESSION['soal_sekarang'];
$jawaban = $_SESSION['jawaban'];
$nilai = $_SESSION['nilai'];

// Navigasi Soal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // if(isset($_POST['jawaban'])){
    //     $jawaban[$soal_sekarang] = $_POST['jawaban'];
    // }


    // Navigasi Soal
    if (isset($_POST['next'])) {
        $soal_sekarang += 1;
    } elseif (isset($_POST['prev'])) {
        dd($_SERVER['REQUEST_METHOD']);
        $soal_sekarang -= 1;
    } elseif (isset($_POST['submit'])) {
        dd();
    }


}
$soal = $data_soal[$soal_sekarang];   
?>

<p id="kumpulan-soal" hidden>{{$data_dari_json}}</p>

<div class=" mb-3" id="halaman-latihan">
    <h1>Latihan</h1>


    <div class="row">

        <div class="col-8 p-2">
            <div class="progress rounded" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0.001%"
                    id="bar"></div>
            </div>
            <div class="card shadow mt-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <b>Soal No. <span id="no-soal"></span></b>
                        </div>
                        <div class="col text-end">
                            <b><i class="bi bi-clock text-end"></i> <span id="menit">30</span>:<span
                                    id="detik">00</span></b>
                        </div>
                    </div>
                </div>
                {{-- Menampilkan Soal --}}

                <div class="card-body">
                    <div class="card p-4">
                        <p id="soal"></p>
                        <ol class="mt-4" type="a">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                    value="a">
                                <label class="form-check-label" for="exampleRadios2" id="pilihan-1"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                    value="b">
                                <label class="form-check-label" for="exampleRadios3" id="pilihan-2"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                                    value="c">
                                <label class="form-check-label" for="exampleRadios4" id="pilihan-3"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5"
                                    value="d">
                                <label class="form-check-label" for="exampleRadios5" id="pilihan-4"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6"
                                    value="e">
                                <label class="form-check-label" for="exampleRadios6" id="pilihan-5"></label>
                            </div>
                        </ol>
                    </div>
                </div>

            </div>
            <div class="row">
                {{-- Navigasi Next dan Prev --}}
                <div class="col-6">
                    <input class="btn btn-primary mt-6" type="submit" name="prev" value="Sebelumnya" id="prev"
                        onclick="prev()">
                </div>
                <div class="col-6 text-end">
                    <input class="btn btn-primary mt-6" type="submit" name="next" value="Selanjutnya" id="next"
                        onclick="next()">
                </div>
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="card shadow">
                <div class="card-header">
                    Daftar Soal
                </div>
                <div class="card-header">
                    <table class="table table-sm">
                        <tr class="text-center">
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">1</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">2</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">3</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">4</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">5</td>
                        </tr>
                        <tr class="text-center">
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">6</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">7</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">8</td>
                            <td class="soal btn list_soal"
                                style="background: whitesmoke; padding-left: 9px; padding-right: 9px;">9</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">10</td>
                        </tr>
                        <tr class="text-center">
                            <td class="soal btn list_soal" style="background: whitesmoke">11</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">12</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">13</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">14</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">15</td>
                        </tr>
                        <tr class="text-center">
                            <td class="soal btn list_soal" style="background: whitesmoke">16</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">17</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">18</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">19</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">20</td>
                        </tr>
                        <tr class="text-center">
                            <td class="soal btn list_soal" style="background: whitesmoke">21</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">22</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">23</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">24</td>
                            <td class="soal btn list_soal" style="background: whitesmoke">25</td>
                        </tr>
                    </table>
                </div>
                <div class="card-body text-sm">
                    <p class="m-0 card-text">Hijau = Sudah dijawab</p>
                    <p class="m-0 card-text">Putih = Belum dijawab</p>
                </div>
            </div>
            <div class="card shadow">
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-success m-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Selesai</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selesai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="selesaiForm" action="{{ route('simpanNilai') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="hidden" name="nilai_akhir" id="nilaiAkhirInput">
                    <input type="hidden" name="aspek" value="evaluasi">
                    <input type="hidden" name="benar" id="benarInput" value="">
                    <input type="hidden" name="salah" id="salahInput" value="">
                    <input type="hidden" name="lama_waktu_pengerjaan" id="lamaWaktuPengerjaanInput">

                    <div class="modal-body">
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="selesai()">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>





{{-- Script Interaktiftas soal --}}

<script>
    // Membuat tampilan penuh
    document.getElementById('leftCol').hidden = true;
    document.getElementById('navbarHead').hidden = true;
    document.getElementById('content-wrapper').classList.remove('content-wrapper')

    // Countdown Timer
    const menit = document.getElementById('menit');
    const detik = document.getElementById('detik');

    let startTime, endTime;

    function startCountdown(duration) {
        let timer = duration, minutes, seconds;
        startTime = new Date(); // Menyimpan waktu mulai

        countdownInterval = setInterval(function () {
            minutes = Math.floor(timer / 60);
            seconds = timer % 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            menit.innerHTML = minutes;
            detik.innerHTML = seconds;

            if (--timer < 0) {
                timer = duration;
                alert("Waktu habis!");
                window.location.href = "info";
            }
        }, 1000);
    }

    function stopCountdown() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null; // Reset interval ID

            endTime = new Date(); // Menyimpan waktu selesai
            const elapsedTime = Math.floor((endTime - startTime) / 1000); // Hitung waktu dalam detik

            // Cetak waktu terakhir di console
            const minutes = Math.floor(elapsedTime / 60);
            const seconds = elapsedTime % 60;
            console.log(`Waktu terakhir: ${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`);

            return elapsedTime;
        }
    }

    window.onload = function () {
        const thirtyMinutes = 60 * 30;
        startCountdown(thirtyMinutes);
    };

    // Mengambil kumpulan soal
    //console.log($soal);
    const $soal_soal = document.getElementById('kumpulan-soal');
    // console.log('Hello World');

    // Mengubah data JSON dari HTML ke JSON Javascript, perlu dua kali parse
    const $data_soal = JSON.parse(JSON.parse($soal_soal.innerHTML));
    console.log('Ini panjang $data_soal', $data_soal.length);

    // Cek isi data Soal di Console Log
    // console.log($data_soal)
    // console.log($data_soal[0]['pilihan'][0]['teks'])

    // Menampilkan soal pada halaman
    const $soal = document.getElementById('soal');
    const $pilihan_1 = document.getElementById('pilihan-1');
    const $pilihan_2 = document.getElementById('pilihan-2');
    const $pilihan_3 = document.getElementById('pilihan-3');
    const $pilihan_4 = document.getElementById('pilihan-4');
    const $pilihan_5 = document.getElementById('pilihan-5');
    var $soal_sekarang = 0;

    // Menghapus semua soal dan jawaban
    function hapus_soal() {
        $soal.innerHTML = ''
        $pilihan_1.innerHTML = ''
        $pilihan_2.innerHTML = ''
        $pilihan_3.innerHTML = ''
        $pilihan_4.innerHTML = ''
    }

    // Menampikan nomor soal
    const no_soal = document.getElementById('no-soal');
    function nomor_soal($no) {
        no_soal.innerHTML = $no;
    }
    nomor_soal($soal_sekarang + 1);

    // Uncheck
    const $pilgan = document.getElementsByClassName('form-check-input');
    // console.log($pilgan);
    function uncheck() {
        for (let pilihan = 0; pilihan < $pilgan.length; pilihan++) {
            $pilgan[pilihan].checked = false;
        }
    }

    function isi_soal($nomor) {
        // for(let i = 0; i < 26; i++){
        //     console.log($data_soal[i])
        // }
        $soal.innerHTML = $data_soal[$nomor]['pertanyaan']
        $pilihan_1.innerHTML = $data_soal[$nomor]['pilihan'][0]['teks']
        $pilihan_2.innerHTML = $data_soal[$nomor]['pilihan'][1]['teks']
        $pilihan_3.innerHTML = $data_soal[$nomor]['pilihan'][2]['teks']
        $pilihan_4.innerHTML = $data_soal[$nomor]['pilihan'][3]['teks']
        $pilihan_5.innerHTML = $data_soal[$nomor]['pilihan'][4]['teks']
    }

    // Update list soal
    // let nomor_soal_di_list = document.getElementsByClassName('list_soal')
    // nomor_soal_di_list[0].style.background = 'green';
    // nomor_soal_di_list[0].style.text = 'green';
    // console.log(nomor_soal_di_list[0].innerHTML)


    isi_soal($soal_sekarang)

    // Matikan Tombol
    function nav_tombol() {
        // console.log($soal_sekarang)
        if ($soal_sekarang == 24) {
            document.getElementById('next').disabled = true;
            document.getElementById('prev').disabled = false;
        } else if ($soal_sekarang == 0) {
            document.getElementById('prev').disabled = true;
            document.getElementById('next').disabled = false;
        } else {
            document.getElementById('prev').disabled = false;
            document.getElementById('next').disabled = false;
        }
    }

    nav_tombol()




    // Navigasi
    function next() {
        console.log('Next')
        $soal_sekarang++;
        jawaban_check()
        hapus_soal()
        isi_soal($soal_sekarang)
        nav_tombol()
        nomor_soal($soal_sekarang + 1);


    }
    function prev() {
        console.log('Prev')

        $soal_sekarang--;
        jawaban_check();
        hapus_soal()
        isi_soal($soal_sekarang)
        nav_tombol()
        nomor_soal($soal_sekarang + 1);
    }


    // Bank Soal
    var terjawab = 0;
    const kunci_jawaban = [];
    // Mengambil kunci jawaban dari dalam data
    let abjad;
    for (let d = 0; d < 25; d++) {
        console.log($data_soal[d])
        for (let e = 0; e < 5; e++) {
            console.log($data_soal[d]['pilihan'][e])
            if ($data_soal[d]['pilihan'][e]['benar_salah'] == true) {
                if ($data_soal[d]['pilihan'][e]['id'] == 1) {
                    $abjad = 'a'
                } else if ($data_soal[d]['pilihan'][e]['id'] == 2) {
                    $abjad = 'b'
                } else if ($data_soal[d]['pilihan'][e]['id'] == 3) {
                    $abjad = 'c'
                } else if ($data_soal[d]['pilihan'][e]['id'] == 4) {
                    $abjad = 'd'
                } else if ($data_soal[d]['pilihan'][e]['id'] == 5) {
                    $abjad = 'e'
                }
                kunci_jawaban[d] = $abjad;
            }
        }
    }
    console.log(kunci_jawaban)


    let jawaban_mhs = {};
    function simpan_jawaban() {
        if (jawaban_mhs[$soal_sekarang] == null) {
            terjawab += 1;
            progressBar()
        }
        for (let k = 0; k < 5; k++) {
            if ($pilgan[k].checked) {
                jawaban_mhs[$soal_sekarang] = $pilgan[k].value
            }
        }
        console.log(jawaban_mhs);
        list_soal[$soal_sekarang].style.background = 'green'
        list_soal[$soal_sekarang].style.color = 'white'

    }


    // Cek soal yang telah terjawab
    function jawaban_check() {
        console.log('Soal Sekarang => ', $soal_sekarang)
        if (jawaban_mhs[$soal_sekarang] == null) {
            console.log('Soal ini belum dijawab')
            uncheck()
        } else {
            uncheck()
            for (let pil = 0; pil < 4; pil++) { // Masuk ke pilgan
                if ($pilgan[pil].value == jawaban_mhs[$soal_sekarang]) {
                    $pilgan[pil].checked = true;
                }
            }
        }
    }




    // Check OnClick, langsung simpan jawaban
    const radio = document.querySelectorAll('input[name="exampleRadios"]');

    radio.forEach(radio => {
        radio.addEventListener('click', simpan_jawaban)
    })

    // Navigasi daftar soal
    function go_list(event) {
        console.log('Ditekan')
        console.log(event.currentTarget.innerHTML)
        $soal_sekarang = event.currentTarget.innerHTML - 1
        hapus_soal()
        isi_soal($soal_sekarang)
        nav_tombol()
        nomor_soal($soal_sekarang + 1);
        jawaban_check()
    }
    const list_soal = document.querySelectorAll('.list_soal');
    console.log(list_soal)
    list_soal.forEach(list_soal => {
        list_soal.addEventListener('click', go_list)
    })

    // ProgressBar
    let bar = document.getElementById('bar')
    console.log(bar)
    function progressBar() {
        console.log(terjawab)
        let persen = terjawab * 4;
        bar.style.width = `${persen}%`;
        console.log(bar)
    }

    // Selesai
    const lamanLatihan = document.getElementById('halaman-latihan');
    const hasil = document.getElementById('hasil');
    const show_skor = document.getElementById('skor');
    const jawaban_benar = document.getElementById('benar');
    const jawaban_salah = document.getElementById('salah');
    let benar = 0;
    let salah = 0;

    function periksaJawaban() {
        let benar = 0;
        let salah = 0;
        for (let m = 0; m < 25; m++) {
            console.log(kunci_jawaban[m], jawaban_mhs[m]);
            if (kunci_jawaban[m] == jawaban_mhs[m]) {
                benar += 1;
            } else {
                salah += 1;
            }
        }

        return {
            benar: benar,
            salah: salah,
            nilai_akhir: benar * 4 // Contoh: Skor dihitung dari jumlah benar
        };

    }

    document.addEventListener('DOMContentLoaded', function () {
        function selesai() {
            const waktu = stopCountdown();
            const hasil = periksaJawaban(); 
            console.log('Sudah selesai');
            console.log(lamanLatihan);

            // Dapatkan elemen form dan input
            const form = document.getElementById('selesaiForm');
            const benarInput = document.getElementById('benarInput');
            const salahInput = document.getElementById('salahInput');
            const nilaiAkhirInput = document.getElementById('nilaiAkhirInput');
            const waktuInput = document.getElementById('lamaWaktuPengerjaanInput');

            if (form && nilaiAkhirInput) {
                // Set nilai ke input hidden
                benarInput.value = hasil.benar;
                salahInput.value = hasil.salah;
                nilaiAkhirInput.value = hasil.nilai_akhir;
                waktuInput.value = waktu;

                // Submit form secara otomatis setelah nilai diatur
                console.log('Form ditemukan, melakukan submit');
                form.submit();
            } else {
                console.error('Form atau input tidak ditemukan');
            }

            lamanLatihan.innerHTML = '';
            hasil.style.display = 'block';
        }

        // Menyediakan fungsi global untuk bisa dipanggil dari onclick
        window.selesai = selesai;
    });


</script>

@endsection