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