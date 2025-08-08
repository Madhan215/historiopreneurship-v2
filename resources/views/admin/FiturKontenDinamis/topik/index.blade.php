@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">Daftar Topik</h2>
    <div class="d-flex gap-2 mb-4">
        @if (isset($token))
            <a href="{{ route('topik.create', ['token_kelas' => $token]) }}" class="btn btn-primary">Tambah Topik</a>
            <a href="{{ route('topik.paketMateri', ['token_kelas' => $token]) }}"
                onclick="return confirm('Yakin ingin klaim paket materi default ini?')" class="btn btn-success">
                Klaim Paket Topik & Subtopik
            </a>

            <a href="{{ route('atur-urutan', ['token_kelas' => $token]) }}" class="btn btn-outline-secondary">🔀 Atur Urutan
                Topik & Subtopik</a>
            <a href="{{ route('lihat-urutan', ['token_kelas' => $token]) }}" class="btn btn-primary mb-3">Lihat Urutan Topik &
                Subtopik</a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (isset($token))
        <div class="alert alert-info">
            Menampilkan topik untuk token: <code>{{ $token }}</code>
        </div>
    @endif

    <div class="row g-4">
        @foreach ($topiks as $topik)
            <div class="col-md-12">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">{{ $topik->nama_topik }}</h5>
                        <div class="d-flex align-items-center gap-2">

                            {{-- SWITCH STATUS --}}
                            <form method="POST"
                                action="{{ route('topik.toggleStatus', ['id' => $topik->id_topik, 'token_kelas' => $token]) }}">
                                @csrf
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switch{{ $topik->id_topik }}"
                                        name="status" onchange="this.form.submit()" {{ $topik->status === 'on' ? 'checked' : '' }}>
                                </div>
                            </form>

                            {{-- Edit --}}
                            <a href="{{ route('topik.edit', ['topik' => $topik->id_topik, 'token_kelas' => $token]) }}"
                                class="btn btn-sm btn-warning">Edit</a>

                            {{-- Hapus --}}
                            <form method="POST"
                                action="{{ route('topik.destroy', ['topik' => $topik->id_topik, 'token_kelas' => $token]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">

                        {{-- Materi --}}
                        @if ($topik->materi->count())
                            <div class="mb-3">
                                <h6 class="text-primary fw-bold">📚 Materi</h6>
                                <div class="list-group">
                                    @foreach ($topik->materi as $materi)
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $materi->nama_materi }}</strong>
                                                    <small class="ms-2 text-muted">
                                                        (Status: <span
                                                            class="{{ $materi->status === 'on' ? 'text-success' : 'text-danger' }}">{{ $materi->status === 'on' ? 'Aktif' : 'Tidak Aktif' }}</span>)
                                                    </small>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <form method="POST"
                                                        action="{{ route('materi.toggleStatus', ['id' => $materi->id_materi]) }}">
                                                        @csrf
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="status" {{ $materi->status === 'on' ? 'checked' : '' }} {{ $topik->status === 'off' ? 'disabled' : '' }} onchange="this.form.submit()">
                                                        </div>
                                                    </form>

                                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                        data-bs-target="#materiModal{{ $materi->id_materi }}">Lihat Materi</button>

                                                    <a class="btn btn-sm btn-outline-secondary"
                                                        href="{{ route('subtopik.edit', ['tipe' => 'materi', 'id' => $materi->id_materi]) }}">Edit
                                                        Materi</a>

                                                   <form method="POST"
    action="{{ route('subtopik.destroy', ['tipe' => 'materi', 'id' => $materi->id_materi]) }}"
    onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id_topik" value="{{ $materi->id_topik }}">
    <button class="btn btn-sm btn-outline-danger">Hapus</button>
</form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Evaluasi --}}
                        @if ($topik->evaluasi->count())
                            <div class="mb-3">
                                <h6 class="text-info fw-bold">📝 Evaluasi</h6>
                                <div class="list-group">
                                    @foreach ($topik->evaluasi as $evaluasi)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $evaluasi->nama_evaluasi }}</strong>
                                                <small class="ms-2 text-muted">(Status:
                                                    <span class="{{ $evaluasi->status === 'on' ? 'text-success' : 'text-danger' }}">
                                                        {{ $evaluasi->status === 'on' ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>)
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <form method="POST"
                                                    action="{{ route('evaluasi.toggleStatus', ['id' => $evaluasi->id_evaluasi]) }}">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status" {{ $evaluasi->status === 'on' ? 'checked' : '' }} {{ $topik->status === 'off' ? 'disabled' : '' }} onchange="this.form.submit()">
                                                    </div>
                                                </form>

                                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                    data-bs-target="#modalEvaluasi{{ $evaluasi->id_evaluasi }}">Lihat Soal</button>

                                                <a class="btn btn-sm btn-outline-secondary"
                                                    href="{{ route('subtopik.edit', ['tipe' => 'evaluasi', 'id' => $evaluasi->id_evaluasi]) }}">Edit
                                                    Evaluasi</a>

                                                <form method="POST"
                                                    action="{{ route('subtopik.destroy', ['tipe' => 'evaluasi', 'id' => $evaluasi->id_evaluasi]) }}"
                                                    onsubmit="return confirm('Yakin ingin menghapus evaluasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                        <input type="hidden" name="id_topik" value="{{ $evaluasi->id_topik }}">
                                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Upload --}}
                        @if ($topik->upload->count())
                            <div class="mb-3">
                                <h6 class="text-success fw-bold">📁 Upload</h6>
                                <div class="list-group">
                                    @foreach ($topik->upload as $upload)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $upload->nama_upload }}</strong>
                                                <small class="ms-2 text-muted">(Status:
                                                    <span class="{{ $upload->status === 'on' ? 'text-success' : 'text-danger' }}">
                                                        {{ $upload->status === 'on' ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>)
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <form method="POST"
                                                    action="{{ route('upload.toggleStatus', ['id' => $upload->id_upload]) }}">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status" {{ $upload->status === 'on' ? 'checked' : '' }} {{ $topik->status === 'off' ? 'disabled' : '' }} onchange="this.form.submit()">
                                                    </div>
                                                </form>

                                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalUpload{{ $upload->id_upload }}">Lihat Upload</button>

                                                <a class="btn btn-sm btn-outline-secondary"
                                                    href="{{ route('subtopik.edit', ['tipe' => 'upload', 'id' => $upload->id_upload]) }}">Edit
                                                    Upload</a>

                                                <form method="POST"
                                                    action="{{ route('subtopik.destroy', ['tipe' => 'upload', 'id' => $upload->id_upload]) }}"
                                                    onsubmit="return confirm('Yakin ingin menghapus upload ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                        <input type="hidden" name="id_topik" value="{{ $upload->id_topik }}">
                                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Tambah Subtopik --}}
                        <div class="mt-3">
                            <a href="{{ route('subtopik.create', ['id_topik' => $topik->id_topik]) }}"
                                class="btn btn-sm btn-outline-primary">
                                ➕ Tambah Subtopik
                            </a>
                        </div>

                    </div>
                </div>
            </div>


            {{-- MODAL MATERI --}}
            @if ($topik->materi->count())
                @foreach ($topik->materi as $materi)
                    <div class="modal fade" id="materiModal{{ $materi->id_materi }}" tabindex="-1"
                        aria-labelledby="materiModalLabel{{ $materi->id_materi }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="materiModalLabel{{ $materi->id_materi }}">
                                        {{ $materi->nama_materi }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $materi->konten !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            {{-- BAGIAN UNTUK KONTEN MODAL EVALUASI (DILETAKKAN DI LUAR CARD-BODY) --}}
            @if ($topik->evaluasi->count())
                @foreach ($topik->evaluasi as $evaluasi)
                    <div class="modal fade" id="modalEvaluasi{{ $evaluasi->id_evaluasi }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $evaluasi->id_evaluasi }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="modalLabel{{ $evaluasi->id_evaluasi }}">
                                        Soal: {{ $evaluasi->nama_evaluasi }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    @php $soals = json_decode($evaluasi->konten, true); @endphp
                                    @if (is_array($soals))
                                        <ol>
                                            @foreach ($soals as $soal)
                                                <li class="mb-3">
                                                    <div><strong>Pertanyaan:</strong> {{ $soal['question'] }}</div>
                                                    <ul>
                                                        <li>A. {{ $soal['options'][0] ?? '-' }}</li>
                                                        <li>B. {{ $soal['options'][1] ?? '-' }}</li>
                                                        <li>C. {{ $soal['options'][2] ?? '-' }}</li>
                                                        <li>D. {{ $soal['options'][3] ?? '-' }}</li>
                                                    </ul>
                                                    <div><strong>Jawaban Benar:</strong>
                                                        {{ ['A', 'B', 'C', 'D'][$soal['correct']] ?? '-' }}</div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <p class="text-danger">Konten soal tidak valid.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- MODAL UPLOAD --}}
            @if ($topik->upload->count())
                @foreach ($topik->upload as $upload)
                    <div class="modal fade" id="modalUpload{{ $upload->id_upload }}" tabindex="-1"
                        aria-labelledby="modalUploadLabel{{ $upload->id_upload }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="modalUploadLabel{{ $upload->id_upload }}">
                                        Upload: {{ $upload->nama_upload }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <hr>
                                    {!! $upload->konten !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        @endforeach
    </div>
@endsection