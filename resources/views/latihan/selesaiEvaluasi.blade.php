@extends('layouts.main')

@section('container')
<style>
    #particel-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        /* Agar tidak mengganggu interaksi UI */
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 20px solid yellow;
        /* Warna bintang */
        transform: rotate(35deg);
        animation: fall linear forwards, rotate 3s linear infinite;
    }

    .particle::before,
    .particle::after {
        content: '';
        position: absolute;
        top: -15px;
        left: -10px;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 20px solid yellow;
    }

    .particle::before {
        transform: rotate(-70deg);
    }

    .particle::after {
        transform: rotate(70deg);
    }

    @keyframes fall {
        to {
            transform: translateY(100vh);
            opacity: 0;
        }
    }
</style>
<div id="particle-container"></div>
<div id="particle-container">
    <div class="mt-3" id="hasil">
        <div class="row">
            <div class="col text-center">
                <div class="card">
                    <div class="card-header">
                        HASIL
                    </div>
                    <div class="card-body">
                        <p class="text-center"><b>Benar : </b><span id="benar">{{ $benar }}</span></p>
                        <p class="text-center"><b>Salah : </b><span id="salah">{{ $salah }}</span></p>
                        <p class="text-center"><b>Skor : </b><span id="skor">{{ $skor }}</span></p>
                        <a href="{{ route('info') }}"><button class="btn btn-primary">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- JavaScript untuk efek partikel dan suara -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sound selesai mengerjakan soal
            const victory = new Audio("{{ asset('sound/victory.mp3') }}");
            victory.play();

            // Partikel
            function createParticle() {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Set posisi awal partikel secara acak di atas layar
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = -10 + 'px'; // Mulai sedikit di luar layar bagian atas

                // Set ukuran dan kecepatan jatuh secara acak
                const size = Math.random() * 20 + 5; // Ukuran antara 5px dan 25px
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                const duration = Math.random() * 2 + 3; // Durasi animasi antara 3s dan 5s
                particle.style.animationDuration = duration + 's';

                document.getElementById('particle-container').appendChild(particle);

                // Hapus partikel setelah animasi selesai
                setTimeout(() => {
                    particle.remove();
                }, duration * 1000);
            }

            function triggerParticles() {
                for (let i = 0; i < 100; i++) { // Jumlah partikel yang dihasilkan
                    setTimeout(createParticle, i * 100); // Mengatur jeda antar partikel
                }
            }

            triggerParticles();
        });
    </script>

@endsection
