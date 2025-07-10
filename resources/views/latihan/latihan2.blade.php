@extends('layouts.main')

@section('container')

<style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        border-collapse: collapse;
        margin: 20px;
    }

    td {
        padding: 0;
        margin: 0;
        position: relative;
        /* Ensure td can contain positioned children */
        width: 50px;
        /* Increase width of each cell */
        height: 50px;
        /* Increase height of each cell */
    }

    input[type="text"] {
        width: 100%;
        height: 100%;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 2em;
        /* Increase font size */
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    input[type="text"].empty {
        background-color: #eee;
        /* Light grey for empty cells */
        border: 1px solid #ccc;
        /* Light border for empty cells */
    }

    input[type="text"]:disabled {
        background-color: #ddd;
        /* Darker grey for disabled cells */
        color: #aaa;
        /* Light grey text color */
        cursor: not-allowed;
        border: 1px solid #ddd;
        /* Keep border same as empty cells for consistency */
    }

    input[type="text"]:focus {
        border-color: #007bff;
        /* Blue border */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Subtle blue glow */
    }


    .number-label {
        position: absolute;
        top: 1px;
        /* Adjusted for better visibility */
        left: 1px;
        /* Adjusted for better visibility */
        font-size: 1em;
        /* Increase font size for labels */
        color: #333;
        /* Dark color for better visibility */
        padding: 2px;
        border-radius: 4px;
        /* Rounded corners for label */
        z-index: 1;
        /* Ensure label appears above input */
        text-align: center;
        /* Center text inside label */
    }

    .correct {
        background-color: #2af85a;
        /* Light green for correct answers */
    }

    .incorrect {
        background-color: #f3293a;
        /* Light red for incorrect answers */
        border: 1px solid #f5c6cb;
        /* Darker border for visibility */
    }
</style>

<div class="mt-3">
    <div class="row">
        <div class="col text-center">
            <h2>Teka Teki Silang</h2>
        </div>
        <div class="row mt-5 border d-flex justify-content-between align-items-center">
            <div class="col-sm-7">
                <div id="crossword-container"></div>
            </div>
            <div class="col-sm-5">
                <div id="hints">
                    <h3>Soal Mendatar:</h3>
                    <ul id="across-hints"></ul>
                    <h3>Soal Menurun:</h3>
                    <ul id="down-hints"></ul>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-8 mx-auto text-center">
                <button class="btn btn-primary " id="check-button">Periksa Jawaban</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="resultModalLabel">Hasil Teka Teki Silang</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p id="correct-count-modal" class="font-weight-bold"></p>
                                <p id="incorrect-count-modal" class="font-weight-bold"></p>
                                <p id="score-modal" class="font-weight-bold text-success"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <form id="tutupForm" action="{{ route('TTS') }}" method="POST">
                            @csrf
                            <input type="hidden" id="nilaiAkhirInput" name="nilai_akhir">
                            <input type="hidden" name="aspek" value="poin_TTS">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="materi-a"></div>

<script>
    const $sub = 0;
    const materi_a = document.getElementsByClassName('materi-a');

    document.addEventListener('DOMContentLoaded', () => {
        const crosswordData = {
            questions: [
                // Menurun
                { id: 1, direction: 'down', startX: 1, startY: 5, answer: 'LOKSADO', clue: 'Salah satu tempat wisata di kalimantan selatan', no: 1 },
                { id: 2, direction: 'down', startX: 3, startY: 3, answer: 'BANJARMASIN', clue: 'Lokasi Makam Pangeran Antasari', no: 2 },
                { id: 3, direction: 'down', startX: 6, startY: 9, answer: 'KUIN', clue: 'Tempat bersejarah, dikenal sebagai asal mula Kesultanan Banjar', no: 3 },
                { id: 4, direction: 'down', startX: 5, startY: 1, answer: 'PANGERAN', clue: 'Gelar Kebangsawanan Kerajaan Banjar', no: 4 },
                { id: 5, direction: 'down', startX: 8, startY: 3, answer: 'SURIANSYAH', clue: 'Nama Raja pertama Kesultanan Banjar', no: 5 },
                { id: 6, direction: 'down', startX: 13, startY: 0, answer: 'BAJUIN', clue: 'Air Terjun yang berada pada kabupaten tanah laut', no: 6 },
                { id: 7, direction: 'down', startX: 14, startY: 6, answer: 'HARATAI', clue: 'Air Terjun yang berada pada kabupaten Hulu Sungai Selatan', no: 7 },
                { id: 8, direction: 'down', startX: 17, startY: 5, answer: 'SASIRANGAN', clue: 'Kain khas kalimantan selatan', no: 8 },

                // Mendatar
                { id: 9, direction: 'across', startX: 0, startY: 5, answer: 'ULIN', clue: 'Kayu Khas Kalimantan', no: 1 },
                { id: 10, direction: 'across', startX: 3, startY: 3, answer: 'BUNGAS', clue: 'Bahasa Banjar cantik', no: 2 },
                { id: 11, direction: 'across', startX: 3, startY: 11, answer: 'SABILALMUHTADIN', clue: 'Masjid yang ada di Banjarmasin', no: 3 },
                { id: 12, direction: 'across', startX: 5, startY: 1, answer: 'PASARTERAPUNG', clue: 'Pasar khas kalimantan selatan', no: 4 },
                { id: 13, direction: 'across', startX: 12, startY: 3, answer: 'NUKAR', clue: 'Bahasa Banjar beli', no: 5 },
                { id: 14, direction: 'across', startX: 10, startY: 7, answer: 'SULTAN', clue: 'Gelar Pemimpin Kesultanan', no: 6 },
                { id: 15, direction: 'across', startX: 11, startY: 9, answer: 'RAJA', clue: 'Gelar Pemimpin Kerajaan', no: 7 },
            ]
        };

        // Calculate grid size to ensure all answers fit
        let maxX = 0;
        let maxY = 0;

        crosswordData.questions.forEach(q => {
            if (q.direction === 'across') {
                maxX = Math.max(maxX, q.startX + q.answer.length - 1);
            } else {
                maxY = Math.max(maxY, q.startY + q.answer.length - 1);
            }
            maxX = Math.max(maxX, q.startX); // Ensure maxX considers starting position
            maxY = Math.max(maxY, q.startY); // Ensure maxY considers starting position
        });

        const gridWidth = maxX + 1;
        const gridHeight = maxY + 1;

        const container = document.getElementById('crossword-container');
        const table = document.createElement('table');

        // Create the crossword grid
        for (let row = 0; row < gridHeight; row++) {
            const tr = document.createElement('tr');
            for (let col = 0; col < gridWidth; col++) {
                const td = document.createElement('td');
                const input = document.createElement('input');
                input.type = 'text';
                input.maxLength = 1;
                input.dataset.x = col;
                input.dataset.y = row;
                input.className = 'empty'; // Set initial class
                input.disabled = true; // Disable initially

                const numberLabel = document.createElement('span');
                numberLabel.className = 'number-label';
                numberLabel.style.display = 'none'; // Hide by default

                td.appendChild(numberLabel);
                td.appendChild(input);
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }

        container.appendChild(table);

        const cells = Array.from(document.querySelectorAll('#crossword-container input'));
        const labels = Array.from(document.querySelectorAll('#crossword-container .number-label'));

        // Function to place the answers into the grid
        function placeAnswers() {
            crosswordData.questions.forEach(question => {
                const { id, startX, startY, direction, answer } = question;
                for (let i = 0; i < answer.length; i++) {
                    const x = direction === 'across' ? startX + i : startX;
                    const y = direction === 'down' ? startY + i : startY;
                    const cell = cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y);
                    const label = labels.find(l => parseInt(l.parentElement.querySelector('input').dataset.x) === x &&
                        parseInt(l.parentElement.querySelector('input').dataset.y) === y);

                    if (cell) {
                        cell.classList.remove('empty'); // Remove 'empty' class
                        cell.disabled = false; // Enable the cell
                        cell.value = ''; // Clear the cell value
                    }

                    // Add label only if it is the starting cell of the row or column
                    if (label && ((direction === 'across' && i === 0) || (direction === 'down' && i === 0))) {
                        label.textContent = question.no; // Set the question number only at the start of the row or column
                        label.style.display = 'block'; // Ensure label is visible
                    } else if (label) {
                        // Hide the label for cells that do not start a word
                        label.style.display = 'none';
                    }
                }
            });
        }

        placeAnswers();

        // Handle keyboard navigation
        cells.forEach(cell => {
            cell.addEventListener('keydown', (event) => {
                if (cell.disabled) return; // Ignore key events if cell is disabled

                const { x, y } = cell.dataset;
                const currentX = parseInt(x);
                const currentY = parseInt(y);

                if (event.key === 'ArrowRight') {
                    moveToCell(currentX + 1, currentY);
                } else if (event.key === 'ArrowDown') {
                    moveToCell(currentX, currentY + 1);
                } else if (event.key === 'ArrowLeft') {
                    moveToCell(currentX - 1, currentY);
                } else if (event.key === 'ArrowUp') {
                    moveToCell(currentX, currentY - 1);
                }
            });

            cell.addEventListener('input', () => {
                if (cell.disabled) return; // Ignore input events if cell is disabled

                if (cell.value.length > 1) {
                    cell.value = cell.value.slice(0, 1);
                }
                if (cell.value) {
                    // Move focus based on the direction of input
                    const { x, y } = cell.dataset;
                    const currentX = parseInt(x);
                    const currentY = parseInt(y);

                    // Move to the next cell in the same row or column
                    const nextCell = moveToNextCell(currentX, currentY);
                    if (nextCell) {
                        nextCell.focus();
                    }
                }
            });

            cell.addEventListener('focus', () => {
                if (cell.disabled) return; // Ignore if cell is disabled

                // Clear the cell content when it gains focus if it has content
                if (cell.value) {
                    cell.value = '';
                }
            });
        });

        function moveToNextCell(x, y) {
            // Find the next cell based on direction
            const nextCell = cells.find(c => parseInt(c.dataset.x) === x + 1 && parseInt(c.dataset.y) === y && !c.disabled) ||
                cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y + 1 && !c.disabled);
            return nextCell;
        }

        function moveToCell(x, y) {
            const nextCell = cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y && !c.disabled);
            if (nextCell) {
                nextCell.focus();
            }
        }

        // Check answers when the button is clicked
        document.getElementById('check-button').addEventListener('click', () => {
            let correctCount = 0;
            let incorrectCount = 0;
            let totalQuestions = crosswordData.questions.length;
            let score = 0;

            // Reset styles for all cells
            cells.forEach(cell => {
                cell.classList.remove('correct', 'incorrect');
            });

            crosswordData.questions.forEach(question => {
                const { startX, startY, direction, answer } = question;
                let userAnswer = '';
                let isCorrect = true;

                for (let i = 0; i < answer.length; i++) {
                    const x = direction === 'across' ? startX + i : startX;
                    const y = direction === 'down' ? startY + i : startY;
                    const cell = cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y);

                    if (cell) {
                        if (cell.value.toUpperCase() !== answer[i].toUpperCase()) {
                            isCorrect = false;
                        }
                        userAnswer += cell.value.toUpperCase(); // Collect user input
                    }
                }

                if (userAnswer === answer) {
                    correctCount++;
                    for (let i = 0; i < answer.length; i++) {
                        const x = direction === 'across' ? startX + i : startX;
                        const y = direction === 'down' ? startY + i : startY;
                        const cell = cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y);
                        if (cell) {
                            cell.classList.add('correct');
                        }
                    }
                } else {
                    incorrectCount++;
                    for (let i = 0; i < answer.length; i++) {
                        const x = direction === 'across' ? startX + i : startX;
                        const y = direction === 'down' ? startY + i : startY;
                        const cell = cells.find(c => parseInt(c.dataset.x) === x && parseInt(c.dataset.y) === y);
                        if (cell) {
                            cell.classList.add('incorrect');
                        }
                    }
                }
            });

            // Calculate score
            score = (correctCount / totalQuestions) * 100;

            // Update feedback in modal
            document.getElementById('correct-count-modal').textContent = `Jawaban Benar: ${correctCount}`;
            document.getElementById('incorrect-count-modal').textContent = `Jawaban Salah: ${incorrectCount}`;
            document.getElementById('score-modal').textContent = `Nilai Anda: ${Math.round(score)}`;
            // Masukkan total nilai ke dalam input hidden
            document.getElementById('nilaiAkhirInput').value = score;

            // Show the modal
            $('#resultModal').modal('show');
        });

        //close modal
        document.querySelector('[data-dismiss="modal"]').addEventListener('click', () => {
            $('#resultModal').modal('hide');
            document.getElementById('tutupForm').submit();
        });


        // Populate the hints
        const acrossHints = document.getElementById('across-hints');
        const downHints = document.getElementById('down-hints');

        crosswordData.questions.forEach(question => {
            const hintElement = document.createElement('li');
            hintElement.textContent = `Soal ${question.no}: ${question.clue}`;
            if (question.direction === 'across') {
                acrossHints.appendChild(hintElement);
            } else {
                downHints.appendChild(hintElement);
            }
        });
    });

</script>

@endsection