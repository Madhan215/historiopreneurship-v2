const kotakJawaban = document.getElementById('kotakJawaban');
const soalContainer = document.querySelector('.soal');

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