@extends('layouts.main')

@section('container-content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Jawaban Individu</h2>
                <h5 class="text-muted">Nama : {{ $user->nama_lengkap }}</h5>
            </div>
            <a href="{{ url('/Data-Nilai') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <h4 class="fw-bold mb-3">File Upload Siswa</h4>

        @if ($uploadDinamisList->isEmpty())
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i>Tidak ada tugas upload untuk kelas ini.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Upload (Aspek)</th>
                            <th>Nama File</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uploadDinamisList as $index => $upload)
                            @php
                                // Cari file siswa berdasarkan nama_upload (aspek)
                                $file = $fileUploads->firstWhere('kategori', $upload->nama_upload);
                                $nilai = $nilaiMap[$upload->nama_upload] ?? null;
                                $feedback = $feedbackMap[$upload->nama_upload] ?? null;
                                $ext = $file ? strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION)) : null;
                            @endphp

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $upload->nama_upload }}</td>
                                <td>
                                    @if ($file)
                                        {{ $file->original_name }}
                                    @else
                                        <span class="text-muted fst-italic">Belum ada file dikumpulkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($file)
                                        <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#viewFile{{ $index }}">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </button>
                                    @endif

                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#nilai{{ $index }}">
                                        <i class="fas fa-pen me-1"></i>Nilai
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Lihat File --}}
                            @if ($file)
                                <div class="modal fade" id="viewFile{{ $index }}" tabindex="-1"
                                    aria-labelledby="viewFileLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content shadow-lg">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="viewFileLabel{{ $index }}">
                                                    <i class="fas fa-file me-2"></i>{{ $file->original_name }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center p-5">
                                                @if ($ext === 'pdf')
                                                    <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf"
                                                        width="100%" height="600px" />
                                                @else
                                                    <div id="loadingContainer{{ $index }}">
                                                        <h5 class="text-muted mb-3">
                                                            Tunggu sebentar... File akan terbuka di tab baru.
                                                        </h5>
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                            const modal{{ $index }} = document.getElementById("viewFile{{ $index }}");
                                                            modal{{ $index }}.addEventListener("shown.bs.modal", function () {
                                                                const fileUrl = "{{ asset('storage/' . $file->file_path) }}";
                                                                const newTab = window.open(fileUrl, "_blank");
                                                                if (newTab) {
                                                                    setTimeout(() => {
                                                                        const modalInstance = bootstrap.Modal.getInstance(modal{{ $index }});
                                                                        modalInstance.hide();
                                                                    }, 1500);
                                                                } else {
                                                                    document.getElementById("loadingContainer{{ $index }}").innerHTML =
                                                                        '<div class="alert alert-warning mt-3">Harap izinkan pop-up di browser Anda untuk melihat file.</div>';
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Modal Penilaian --}}
                            <div class="modal fade" id="nilai{{ $index }}" tabindex="-1" aria-labelledby="nilaiLabel{{ $index }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content shadow">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="nilaiLabel{{ $index }}">
                                                <i class="fas fa-clipboard-check me-2"></i>Penilaian: {{ $upload->nama_upload }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="aspek" value="{{ $upload->nama_upload }}">
                                                <input type="hidden" name="tipe" value="file_upload">

                                                <div class="mb-3">
                                                    <label class="form-label">Nilai</label>
                                                    <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                                        value="{{ $nilai }}" {{ $nilai !== null ? 'readonly' : '' }} required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Feedback</label>
                                                    <textarea class="form-control" name="data_jawaban_penilai" rows="4"
                                                        placeholder="Masukkan feedback..." {{ $feedback !== null ? 'readonly' : '' }}>{{ $feedback }}</textarea>
                                                </div>

                                                @if ($nilai === null)
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-paper-plane me-1"></i>Kirim Nilai
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="alert alert-info mb-0">
                                                        File ini sudah dinilai.
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection