@extends('layouts.main')

@section('container-content')
<h4>Edit Subtopik: {{ ucfirst($tipe) }}</h4>
@php
    $id = $tipe === 'materi' ? $data->id_materi : ($tipe === 'evaluasi' ? $data->id_evaluasi : $data->id_upload);
@endphp

<form id="form-subtopik" action="{{ route('subtopik.update', [$tipe, $id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id_topik" value="{{ $id_topik }}">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if ($tipe === 'materi')
                        <div class="mb-3">
                            <label class="form-label">Nama Materi</label>
                            <input type="text" name="nama_materi" class="form-control" value="{{ $data->nama_materi }}">
                        </div>
                    @elseif ($tipe === 'evaluasi')
                        <div class="mb-3">
                            <label class="form-label">Nama Evaluasi</label>
                            <input type="text" name="nama_evaluasi" class="form-control" value="{{ $data->nama_evaluasi }}">
                        </div>
                    @elseif ($tipe === 'upload')
                        <div class="mb-3">
                            <label class="form-label">Nama Upload</label>
                            <input type="text" name="nama_upload" class="form-control" value="{{ $data->nama_upload }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Jenis File</label>
                            <select name="tipe_file" class="form-control">
                                @foreach(['word', 'excel', 'pdf', 'image', 'video'] as $tipeFile)
                                    <option value="{{ $tipeFile }}" {{ $data->tipe_file == $tipeFile ? 'selected' : '' }}>{{ ucfirst($tipeFile) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi_upload" class="form-control" value="{{ $data->deskripsi }}">
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if ($tipe === 'materi')
                        <label class="form-label"><strong>Editor Materi</strong></label>
                        <div id="editor" style="height: 300px; background-color: white;">{!! $data->konten !!}</div>
                        <input type="hidden" name="konten_materi" id="konten_materi">
                    @elseif ($tipe === 'evaluasi')
                        <div id="soal-container"></div>
                        <input type="hidden" name="soal_json" id="soal_json">
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body bg-light">
                    <h5 class="fw-bold mb-3"><i class="bi bi-eye"></i> Live Preview</h5>
                    <div id="live-preview" class="p-3 border rounded bg-white" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Scripts --}}
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tipe = "{{ $tipe }}";

    if (tipe === 'materi') {
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis konten materi...',
            modules: {
                toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered' }, { 'list': 'bullet' }], ['link', 'image'], ['clean']],
                imageResize: { modules: ['Resize', 'DisplaySize'] }
            }
        });

        document.getElementById('live-preview').innerHTML = quill.root.innerHTML;

        quill.on('text-change', () => {
            document.getElementById('live-preview').innerHTML = quill.root.innerHTML;
        });

        document.getElementById('form-subtopik').addEventListener('submit', function () {
            document.getElementById('konten_materi').value = quill.root.innerHTML;
        });

    } else if (tipe === 'evaluasi') {
        let soalData = @json($data->konten);
        if (typeof soalData === 'string') {
            try {
                soalData = JSON.parse(soalData);
            } catch (e) {
                alert('Format soal tidak valid!');
                soalData = [];
            }
        }

        const container = document.getElementById('soal-container');
        const preview = document.getElementById('live-preview');

        soalData.forEach((soal, i) => {
            const options = soal.options?.length ? soal.options : ['', '', '', ''];
            container.innerHTML += `
                <div class="border rounded p-3 mb-3">
                    <h6>Soal ${i + 1}</h6>
                    <label>Pertanyaan</label>
                    <textarea class="form-control question" data-index="${i}" rows="2">${soal.question}</textarea>
                    <label class="mt-2">Pilihan</label>
                    ${options.map((opt, j) => `
                        <input type="text" class="form-control option my-1" data-index="${i}" data-option="${j}" value="${opt}" placeholder="Pilihan ${String.fromCharCode(65 + j)}">
                    `).join('')}
                    <label class="mt-2">Jawaban Benar</label>
                    <select class="form-select correct" data-index="${i}">
                        ${[0, 1, 2, 3].map(j => `
                            <option value="${j}" ${soal.correct == j ? 'selected' : ''}>Pilihan ${String.fromCharCode(65 + j)}</option>
                        `).join('')}
                    </select>
                </div>`;
        });

        document.getElementById('form-subtopik').addEventListener('submit', function (e) {
            const soalList = [];
            const jumlah = document.querySelectorAll('.question').length;

            for (let i = 0; i < jumlah; i++) {
                const question = document.querySelector(`.question[data-index="${i}"]`)?.value.trim();
                const options = Array.from(document.querySelectorAll(`.option[data-index="${i}"]`)).map(o => o.value.trim());
                const correct = parseInt(document.querySelector(`.correct[data-index="${i}"]`)?.value);

                if (!question || options.some(opt => !opt)) {
                    alert("Lengkapi semua soal dan jawaban.");
                    e.preventDefault();
                    return;
                }

                soalList.push({ question, options, correct });
            }

            document.getElementById('soal_json').value = JSON.stringify(soalList);
        });

        container.addEventListener('input', () => {
            const jumlah = document.querySelectorAll('.question').length;
            preview.innerHTML = '';

            for (let i = 0; i < jumlah; i++) {
                const question = document.querySelector(`.question[data-index="${i}"]`)?.value;
                const options = Array.from(document.querySelectorAll(`.option[data-index="${i}"]`)).map(opt => opt.value);

                const html = `
                    <div class="mb-3">
                        <p><strong>Soal ${i + 1}:</strong> ${question}</p>
                        <ol type="A">
                            ${options.map(opt => `<li>${opt}</li>`).join("")}
                        </ol>
                    </div>`;
                preview.innerHTML += html;
            }
        });

        container.dispatchEvent(new Event('input'));

    } else if (tipe === 'upload') {
        const preview = document.getElementById('live-preview');
        const nama = document.querySelector('input[name="nama_upload"]');
        const tipeFile = document.querySelector('select[name="tipe_file"]');
        const deskripsi = document.querySelector('input[name="deskripsi_upload"]');

        function updatePreview() {
            preview.innerHTML = `
                <p><strong>Nama:</strong> ${nama.value}</p>
                <p><strong>Tipe File:</strong> ${tipeFile.value}</p>
                <p><strong>Deskripsi:</strong> ${deskripsi.value}</p>
            `;
        }

        [nama, tipeFile, deskripsi].forEach(el => el.addEventListener('input', updatePreview));
        updatePreview();
    }
});
</script>
@endsection
