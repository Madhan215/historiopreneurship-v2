const jawabanElements = document.querySelectorAll('.jawaban');
let correctAnswers = 0;

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
    historioNilai = historioJawaban.length * 10; // Setiap jawaban benar bernilai 10

    const nonHistorioJawaban = document.querySelectorAll('#kotakNonHistorio .jawaban2[data-category="non-historio"]');
    nonHistorioNilai = nonHistorioJawaban.length * 10; // Setiap jawaban benar bernilai 10

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