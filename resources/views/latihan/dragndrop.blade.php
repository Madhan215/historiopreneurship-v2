@extends('layouts.main')

@section('container')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop</title>
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
</head>

<body>
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

    <div class="materi-a"></div>

 

    <script>
        const $sub = 0;
        const materi_a = document.getElementsByClassName('materi-a');
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
</body>

</html>
@endsection