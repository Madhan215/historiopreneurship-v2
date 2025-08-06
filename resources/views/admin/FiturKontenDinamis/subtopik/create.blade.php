@extends('layouts.main')

@section('container-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h4>Tambah Subtopik</h4>

    <form id="form-subtopik" action="{{ route('subtopik.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="id_topik" value="{{ $id_topik }}">

        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-ui-checks-grid"></i> Jenis Subtopik</h5>
                        <div class="mb-3">
                            <select name="tipe" class="form-select" required onchange="showForm(this.value)">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="materi">📄 Materi</option>
                                <option value="evaluasi">📝 Evaluasi</option>
                                <option value="upload">📎 Upload</option>
                            </select>
                        </div>

                        <div id="nama-materi-group" class="mb-3 d-none">
                            <label class="form-label">Nama Materi</label>
                            <input type="text" name="nama_materi" class="form-control"
                                placeholder="Contoh: Pengantar Logika">
                        </div>

                        <div id="nama-evaluasi-group" class="mb-3 d-none">
                            <label class="form-label">Nama Evaluasi</label>
                            <input type="text" name="nama_evaluasi" class="form-control"
                                placeholder="Contoh: Evaluasi Bab 1">
                        </div>

                        <div id="jumlah-soal-group" class="mb-3 d-none">
                            <label class="form-label">Jumlah Soal</label>
                            @foreach ([5, 10, 15, 20] as $j)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jumlah_soal" value="{{ $j }}"
                                        onclick="generateSoal({{ $j }})"> {{ $j }} Soal
                                </div>
                            @endforeach
                        </div>

                        <div id="nama-upload-group" class="mb-3 d-none">
                            <label class="form-label">Nama Upload</label>
                            <input type="text" name="nama_upload" class="form-control" placeholder="Contoh: Tugas Akhir">
                            <label class="form-label mt-2">Tipe File</label>
                            <select name="tipe_file" class="form-select">
                                <option value="word">Word</option>
                                <option value="excel">Excel</option>
                                <option value="pdf">PDF</option>
                                <option value="image">Gambar</option>
                                <option value="video">Video</option>
                            </select>
                            <label class="form-label mt-2">Deskripsi</label>
                            <input type="text" name="deskripsi_upload" class="form-control"
                                placeholder="Misal: Kumpulkan dalam format PDF">
                        </div>

                        <button type="submit" class="btn btn-success mt-4 w-100">
                            <i class="bi bi-save"></i> Simpan Subtopik
                        </button>
                    </div>
                </div>
            </div>

            <!-- Editor & Preview -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div id="form-materi" class="d-none">
                            <h5 class="mb-2"><i class="bi bi-pencil-square"></i> Editor Konten Materi</h5>
                            <div id="editor" style="height: 300px; background-color: white;"></div>
                            <input type="hidden" name="konten_materi" id="konten_materi">
                        </div>

                        <div id="soal-container" class="mt-3"></div>
                        <input type="hidden" name="soal_json" id="soal_json">
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


    {{-- Quill Editor & Resize --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

    <script>
        let quill;

        document.addEventListener("DOMContentLoaded", function () {
            // Inisialisasi Quill editor
            quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Tulis konten materi...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ],
                    imageResize: {
                        modules: ['Resize', 'DisplaySize']
                    }
                }
            });

            // Submit handler
            document.getElementById("form-subtopik").addEventListener("submit", function (e) {
                const tipe = document.querySelector('select[name="tipe"]').value;

                if (tipe === 'materi') {
                    document.getElementById('konten_materi').value = quill.root.innerHTML;
                }

                if (tipe === 'evaluasi') {
                    const soalList = [];
                    const jumlah = document.querySelectorAll('.question').length;

                    for (let i = 0; i < jumlah; i++) {
                        const question = document.querySelector(`.question[data-index="${i}"]`)?.value.trim();
                        const options = Array.from(document.querySelectorAll(`.option[data-index="${i}"]`)).map(opt => opt.value.trim());
                        const correct = parseInt(document.querySelector(`.correct[data-index="${i}"]`)?.value);

                        if (!question || options.some(opt => !opt)) {
                            alert("Lengkapi semua soal dan pilihan.");
                            e.preventDefault();
                            return;
                        }

                        soalList.push({ question, options, correct });
                    }

                    document.getElementById('soal_json').value = JSON.stringify(soalList);
                }
            });

            // Preview Materi
            quill.on('text-change', updateMateriPreview);

            // Preview Upload
            document.querySelector('input[name="nama_upload"]').addEventListener('input', updateUploadPreview);
            document.querySelector('select[name="tipe_file"]').addEventListener('change', updateUploadPreview);
            document.querySelector('input[name="deskripsi_upload"]').addEventListener('input', updateUploadPreview);
        });

        function showForm(tipe) {
            document.getElementById('form-materi').classList.add('d-none');
            document.getElementById('nama-materi-group').classList.add('d-none');
            document.getElementById('nama-evaluasi-group').classList.add('d-none');
            document.getElementById('jumlah-soal-group').classList.add('d-none');
            document.getElementById('nama-upload-group').classList.add('d-none');
            document.getElementById('soal-container').innerHTML = '';
            document.getElementById('live-preview').innerHTML = '';

            if (tipe === 'materi') {
                document.getElementById('form-materi').classList.remove('d-none');
                document.getElementById('nama-materi-group').classList.remove('d-none');
            } else if (tipe === 'evaluasi') {
                document.getElementById('nama-evaluasi-group').classList.remove('d-none');
                document.getElementById('jumlah-soal-group').classList.remove('d-none');
            } else if (tipe === 'upload') {
                document.getElementById('nama-upload-group').classList.remove('d-none');
            }
        }

        function generateSoal(jumlah) {
            const container = document.getElementById('soal-container');
            container.innerHTML = '';

            for (let i = 0; i < jumlah; i++) {
                container.innerHTML += `
                        <div class="border rounded p-3 mb-3">
                            <h6>Soal ${i + 1}</h6>
                            <label>Pertanyaan</label>
                            <textarea class="form-control question" data-index="${i}" rows="2"></textarea>
                            <label class="mt-2">Pilihan</label>
                            <input type="text" class="form-control option my-1" data-index="${i}" placeholder="Pilihan A">
                            <input type="text" class="form-control option my-1" data-index="${i}" placeholder="Pilihan B">
                            <input type="text" class="form-control option my-1" data-index="${i}" placeholder="Pilihan C">
                            <input type="text" class="form-control option my-1" data-index="${i}" placeholder="Pilihan D">
                            <label class="mt-2">Jawaban Benar</label>
                            <select class="form-select correct" data-index="${i}">
                                <option value="0">Pilihan A</option>
                                <option value="1">Pilihan B</option>
                                <option value="2">Pilihan C</option>
                                <option value="3">Pilihan D</option>
                            </select>
                        </div>
                    `;
            }

            updateSoalPreview(); // otomatis tampilkan preview setelah generate
        }

        // Auto update preview soal saat input berubah
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('question') || e.target.classList.contains('option')) {
                updateSoalPreview();
            }
        });

        function updateMateriPreview() {
            const preview = document.getElementById('live-preview');
            if (preview) preview.innerHTML = quill.root.innerHTML;
        }

        function updateSoalPreview() {
            const jumlah = document.querySelectorAll('.question').length;
            const preview = document.getElementById('live-preview');
            preview.innerHTML = '';

            for (let i = 0; i < jumlah; i++) {
                const question = document.querySelector(`.question[data-index="${i}"]`)?.value || '';
                const options = Array.from(document.querySelectorAll(`.option[data-index="${i}"]`)).map(opt => opt.value || '');

                const html = `
                        <div class="mb-3">
                            <p><strong>Soal ${i + 1}:</strong> ${question}</p>
                            <ol type="A">
                                ${options.map(o => `<li>${o}</li>`).join("")}
                            </ol>
                        </div>
                    `;
                preview.innerHTML += html;
            }
        }

        function updateUploadPreview() {
            const nama = document.querySelector('input[name="nama_upload"]').value;
            const tipe = document.querySelector('select[name="tipe_file"]').value;
            const deskripsi = document.querySelector('input[name="deskripsi_upload"]').value;

            const preview = document.getElementById('live-preview');
            if (preview) {
                preview.innerHTML = `
                        <p><strong>Nama:</strong> ${nama}</p>
                        <p><strong>Tipe File:</strong> ${tipe}</p>
                        <p><strong>Deskripsi:</strong> ${deskripsi}</p>
                    `;
            }
        }
    </script>

@endsection