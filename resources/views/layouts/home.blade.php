{{-- Untuk tampilan home --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HISTORIOPRENEURSHIP</title>
    {{-- Bootstrap Lokal --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    {{-- fav icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon.ico') }}">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    {{-- Style untuk warna jawaban Pre Test dan Post Test --}}
    <style>
        .feedback.correct {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
        }
    
        .feedback.wrong {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="min-vh-100 d-flex flex-column">
        <nav class="navbar navbar-expand-md bg-white">
            <div class="py-2 mx-2 mx-sm-auto container">
                <a class="navbar-brand" href="/"><span class="fw-bold text-primary">HISTORIOPRENEURSHIP</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="mx-auto navbar-nav">
                    <a class="nav-link {{ Route::is('beranda') ? 'active fw-semibold' : '' }}" aria-current="page" href="/">Beranda</a>
                    <a class="nav-link {{ Route::is('materi') ? 'active fw-semibold' : '' }}" href="/materi">Materi</a>
                    <a class="nav-link {{ Route::is('perihal') ? 'active fw-semibold' : '' }}" href="/perihal">Perihal</a>
                </div>
                <div class="gap-2 navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Selamat datang {{ auth()->user()->nama_lengkap }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li>
                                    <form action="{{route('login.logout')}}" method="get">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a role="button" tabindex="0" class="btn btn-outline-primary" href="/daftar">DAFTAR</a>
                        <a role="button" tabindex="0" class="btn btn-primary" href="/masuk">MASUK</a>
                    @endauth
                </div>
                </div>
            </div>
        </nav>
        <section>
            <div>
                @yield('container-base')
            </div>
        </section>
        @if(View::hasSection('container'))
        <section class=" text-dark p-3 p-sm-5 mb-5 mb-sm-0 flex-grow-1">
            <div class="container">
                @yield('container')
            </div>
        </section>
        @endif
    </div>
    <footer class="d-flex justify-content-center align-items-center py-2 border">
        <div class="d-flex align-items-center">
            <span class="fw-bold text-primary me-2">HISTORIOPRENEURSHIP</span>
            <span class="text-muted">© 2024</span>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    {{-- Mempertahankan Scroll --}}
    <script>
        // // Menyimpan posisi scroll
        // window.addEventListener('scroll', function () {
        //     localStorage.setItem('scrollPosition', window.scrollY);
        // });

        // // Mengembalikan posisi scroll saat halaman dimuat
        // window.addEventListener('load', function () {
        //     const scrollPosition = localStorage.getItem('scrollPosition');
        //     if (scrollPosition) {
        //         window.scrollTo(0, scrollPosition); // Mengatur posisi scroll
        //     }
        // });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script untuk Pre Test dan Post Test --}}
    <script>
        // Mengunci Test
        let batas_test = document.getElementById('batas_test');
        let mulai_test = document.getElementById('mulai_test');
        if(batas_test.innerHTML == 0){
            mulai_test.classList.add('disabled');
            mulai_test.style.cursor = 'not-allowed';
        }

        let countdown;
        let minutes = 30;
        let seconds = 0;

        function startCountdown() {
            const checkBtn = document.getElementById("checkBtn");
            countdown = setInterval(function() {
                if (minutes === 0 && seconds === 0) {
                    clearInterval(countdown); // Timer selesai
                    alert("Waktu habis!");
                    // Menampilkan Skor
                    disableAllRadios();
                    currentQuestion = 29;
                    checkBtn.innerText = "Cek Skor!";
                    nextQuestion(namaTest);
                } else {
                    if (seconds === 0) {
                        minutes--;
                        seconds = 59;
                    } else {
                        seconds--;
                    }
                    document.getElementById('timerText').innerText =
                        String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
                }
            }, 1000);
        }

        $soal_test = document.getElementById('soal-test');
        $info_test = document.getElementById('info-test');

        function mulai(){
            $info_test.setAttribute('hidden', '');
            $soal_test.removeAttribute('hidden');
            // Memulai countdown saat halaman dimuat
            startCountdown();
        }


            function loadQuestion() {
                
            console.log("Load Question")
            const questionText = document.getElementById("questionText");
            const optionsContainer = document.getElementById("optionsContainer");
            const feedbackContainer = document.getElementById("feedbackContainer");
            const checkBtn = document.getElementById("checkBtn");

            // Reset question and feedback
            questionText.innerText =  currentQuestion + 1 + ". " + questions[currentQuestion].question;
            optionsContainer.innerHTML = '';
            feedbackContainer.style.display = 'none';
            feedbackContainer.innerHTML = '';
            checkBtn.innerText = 'Periksa';
            checkBtn.disabled = false;

            questions[currentQuestion].options.forEach((option, index) => {
                const optionLabel = document.createElement("label");
                const optionRadio = document.createElement("input");
                optionRadio.type = "radio";
                optionRadio.className = "form-check-input mb-2";
                optionRadio.name = "option";
                optionRadio.value = index;
                optionLabel.appendChild(optionRadio);
                optionLabel.appendChild(document.createTextNode(option));
                optionsContainer.appendChild(optionLabel);
                optionsContainer.appendChild(document.createElement("br"));
            });
        }

        function disableAllRadios() {
                const radios = document.querySelectorAll("input[type='radio']");
                radios.forEach(radio => {
                    radio.disabled = true;
                });
            }

        function checkAnswer() {

            
            
            console.log('Cek Jawaban', minutes);



            const selectedOption = document.querySelector('input[name="option"]:checked');

            if(minutes === 0){
                nextQuestion(namaTest);
            }

            if (!selectedOption) return;


            let $status_bar = document.getElementById('status_bar');
            let no_soal = currentQuestion + 1;
            $status_bar.style.width =  `${no_soal * 3.3333333}%`;
            $status_bar.innerHTML =  Math.round(no_soal * 3.3333333) + "%";

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

            if(currentQuestion == 29){
                checkBtn.innerText = "Cek Skor!";
            } else {
                checkBtn.innerText = "Berikutnya";
            }

            checkBtn.onclick = function () {
                nextQuestion(namaTest);
            };
            disableAllRadios();
        }

        function nextQuestion(nama) {
            currentQuestion++;

            if (currentQuestion < questions.length) {
                loadQuestion();
                const checkBtn = document.getElementById("checkBtn");
                checkBtn.onclick = checkAnswer;
                checkBtn.innerText = "Periksa";
            } else {
                // Tampilkan hasil dengan SweetAlert
                let hasil = correctCount * 3.33;
                Swal.fire({
                    title: nama + " Selesai!",
                    text: "Anda mendapatkan skor: " + Math.round(hasil),
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    // Set nilai di form dan submit
                    document.getElementById("nilaiAkhir").value = Math.round(hasil);
                    console.log(minutes);
                    document.getElementById("lama_waktu_pengerjaan").value = minutes;
                    document.getElementById("preTestForm").submit();
                });
            }
        }
        if (document.getElementById('question-container')) {
            loadQuestion();
        }
    </script>

<script src="https://kit.fontawesome.com/c39daf280c.js" crossorigin="anonymous"></script>

</body>
</html>