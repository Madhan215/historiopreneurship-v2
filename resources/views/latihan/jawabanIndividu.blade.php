@extends('layouts.main')

@section('container-content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h2>Jawaban Individu</h2>
    <h4 class="mb-4">Nama : {{$user->nama_lengkap}}</h4>
    <a href="/Data-Nilai" class="btn btn-primary mb-3">Kembali</a>
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="kesejarahan-ii-tab" data-bs-toggle="tab"
                data-bs-target="#kesejarahan-ii" type="button" role="tab" aria-controls="kesejarahan-ii"
                aria-selected="true">Analisis Kelompok Kesejarahan</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kesejarahan-tab" data-bs-toggle="tab" data-bs-target="#kesejarahan"
                type="button" role="tab" aria-controls="kesejarahan" aria-selected="false">Analisis Individu
                Kesejarahan</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kewirausahaan-tab" data-bs-toggle="tab" data-bs-target="#kewirausahaan"
                type="button" role="tab" aria-controls="kewirausahaan" aria-selected="false">Proyek Individu
                Kewirausahaan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="file-upload-tab" data-bs-toggle="tab" data-bs-target="#file-upload"
                type="button" role="tab" aria-controls="file-upload" aria-selected="false">File Upload</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Tab Kesejarahan II -->
        <div class="tab-pane fade show active" id="kesejarahan-ii" role="tabpanel" aria-labelledby="kesejarahan-ii-tab">
            <h3 class="mt-3">Jawaban Kesejarahan II</h3>
            @if($jawabanIndividuII->isEmpty())
                <p>Tidak ada jawaban yang ditemukan untuk Kesejarahan II.</p>
            @else
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>No Objek</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jawabanIndividuII as $index => $jawaban)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jawaban->jawaban }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <h5 class="card-header">
                                Penilaian
                            </h5>
                            <div class="card-body">
                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="aspek" value="analisa_individu_kesejarahan_II">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                            required aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm"
                                            value="{{ $nilaiAnalisisIndividuKesejarahan_II->nilai_akhir ?? '' }}" {{ $nilaiAnalisisIndividuKesejarahan_II ? 'disabled' : '' }}>
                                    </div>
                                    <label for="feedbackIndividu">Feedback</label><br>
                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                        id="feedbackIndividu" rows="5" {{ $nilaiAnalisisIndividuKesejarahan_II ? 'disabled' : '' }}>{{ $nilaiAnalisisIndividuKesejarahan_II->data_jawaban_penilai ?? '' }}</textarea>
                                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                Semangat dalam menilai!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tab Kesejarahan -->
        <div class="tab-pane fade" id="kesejarahan" role="tabpanel" aria-labelledby="kesejarahan-tab">
            <h3 class="mt-3">Jawaban Analisiss Individu Kesejarahan</h3>
            @if($jawabanKesejarahanIndividu->isEmpty())
                <p>Tidak ada jawaban yang ditemukan untuk Kesejarahan.</p>
            @else
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aspek</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jawabanKesejarahanIndividu as $index => $jawaban)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jawaban->aspek }}</td>
                                <td>{{ $jawaban->jawaban }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="mt-3">Jawaban Form Syarat Kelayakan Objek Kesejarahan</h3>
                @if($jawabanFormKelayakan->isEmpty())
                    <p>Belum mengisi Form Kelayakan</p>
                @else
                    <table class="table text-center table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aspek</th>
                                <th>Sub Aspek</th>
                                <th>Skor</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="4">1</td>
                                <td rowspan="4">Daya Tarik</td>
                                <td>{{$jawabanFormKelayakan[0]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[0]->score}}</td>
                                <td>{{$jawabanFormKelayakan[0]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[1]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[1]->score}}</td>
                                <td>{{$jawabanFormKelayakan[1]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[2]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[2]->score}}</td>
                                <td>{{$jawabanFormKelayakan[2]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[3]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[3]->score}}</td>
                                <td>{{$jawabanFormKelayakan[3]->reason}}</td>
                            </tr>
                            <tr>
                                <td rowspan="3">2</td>
                                <td rowspan="3">Aksesbilitas</td>
                                <td>{{$jawabanFormKelayakan[4]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[4]->score}}</td>
                                <td>{{$jawabanFormKelayakan[4]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[5]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[5]->score}}</td>
                                <td>{{$jawabanFormKelayakan[5]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[6]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[6]->score}}</td>
                                <td>{{$jawabanFormKelayakan[6]->reason}}</td>
                            </tr>
                            <tr>
                                <td rowspan="4">3</td>
                                <td rowspan="4">Sarana Prasarana</td>
                                <td>{{$jawabanFormKelayakan[7]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[7]->score}}</td>
                                <td>{{$jawabanFormKelayakan[7]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[8]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[8]->score}}</td>
                                <td>{{$jawabanFormKelayakan[8]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[9]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[9]->score}}</td>
                                <td>{{$jawabanFormKelayakan[9]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[10]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[10]->score}}</td>
                                <td>{{$jawabanFormKelayakan[10]->reason}}</td>
                            </tr>
                            <tr>
                                <td rowspan="7">4</td>
                                <td rowspan="7">Partisipasi Masyarakat</td>
                                <td>{{$jawabanFormKelayakan[11]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[11]->score}}</td>
                                <td>{{$jawabanFormKelayakan[11]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[12]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[12]->score}}</td>
                                <td>{{$jawabanFormKelayakan[12]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[13]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[13]->score}}</td>
                                <td>{{$jawabanFormKelayakan[13]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[14]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[14]->score}}</td>
                                <td>{{$jawabanFormKelayakan[14]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[15]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[15]->score}}</td>
                                <td>{{$jawabanFormKelayakan[15]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[16]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[16]->score}}</td>
                                <td>{{$jawabanFormKelayakan[16]->reason}}</td>
                            </tr>
                            <tr>
                                <td>{{$jawabanFormKelayakan[17]->sub_aspect}}</td>
                                <td>{{$jawabanFormKelayakan[17]->score}}</td>
                                <td>{{$jawabanFormKelayakan[17]->reason}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <h5 class="card-header">
                                Penilaian
                            </h5>
                            <div class="card-body">
                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="aspek" value="analisa_individu_kesejarahan">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                            required aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm"
                                            value="{{ $nilaiAnalisisIndividuKesejarahan->nilai_akhir ?? '' }}" {{ $nilaiAnalisisIndividuKesejarahan ? 'disabled' : '' }}>
                                    </div>
                                    <label for="feedbackIndividu">Feedback</label><br>
                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                        id="feedbackIndividu" rows="5" {{ $nilaiAnalisisIndividuKesejarahan ? 'disabled' : '' }}>{{ $nilaiAnalisisIndividuKesejarahan->data_jawaban_penilai ?? '' }}</textarea>
                                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                Semangat dalam menilai !
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>



        <!-- Tab Kewirausahaan -->
        <div class="tab-pane fade" id="kewirausahaan" role="tabpanel" aria-labelledby="kewirausahaan-tab">
            <h3 class="mt-3">Jawaban Kewirausahaan</h3>
            @if($jawabanKewirausahaanPariwisataIndividu->isEmpty())
                <p>Tidak ada jawaban yang ditemukan untuk Kewirausahaan.</p>
            @else
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aspek</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jawabanKewirausahaanPariwisataIndividu as $index => $jawaban)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jawaban->aspek }}</td>
                                <td>{{ $jawaban->jawaban }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <h5 class="card-header">
                                Penilaian
                            </h5>
                            <div class="card-body">
                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="aspek" value="analisa_individu_kewirausahaan">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                            required aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm"
                                            value="{{ $nilaiAnalisisIndividuKWU->nilai_akhir ?? '' }}" {{ $nilaiAnalisisIndividuKWU ? 'disabled' : '' }}>
                                    </div>
                                    <label for="feedbackIndividu">Feedback</label><br>
                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                        id="feedbackIndividu" rows="5" {{ $nilaiAnalisisIndividuKWU ? 'disabled' : '' }}>{{ $nilaiAnalisisIndividuKWU->data_jawaban_penilai ?? '' }}</textarea>
                                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                Semangat dalam menilai !
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tab File Upload -->
        <div class="tab-pane fade" id="file-upload" role="tabpanel" aria-labelledby="file-upload-tab">
            <h3 class="mt-3">File Upload Siswa</h3>
            @if($fileUploads->isEmpty())
                <p>Tidak ada file upload yang ditemukan.</p>
            @else
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fileUploads as $index => $file)
                                        @if(in_array($file->kategori, ['kegiatan pembelajaran 3', 'praktik lapangan 1', 'proyek individu', 'praktik lapangan 2']))
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $file->kategori }}</td>
                                                <td>{{ $file->original_name }}</td>
                                                <td>
                                                    <!-- Button to trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#pdfModal{{ $index }}">
                                                        Lihat
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="pdfModal{{ $index }}" tabindex="-1"
                                                        aria-labelledby="pdfModalLabel{{ $index }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="pdfModalLabel{{ $index }}">
                                                                        {{ $file->original_name }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <embed src="{{ asset('storage/' . $file->file_path) }}"
                                                                        type="application/pdf" width="100%" height="600px" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $hasKegiatanPembelajaran3 = collect($fileUploads)->contains('kategori', 'kegiatan pembelajaran 3');
                                $hasAktivitas1 = collect($fileUploads)->contains('kategori', 'praktik lapangan 1');
                                $hasAktivitas2 = collect($fileUploads)->contains('kategori', 'praktik lapangan 2');
                                $hasProyekIndividu = collect($fileUploads)->contains('kategori', 'proyek individu');
                            @endphp

                            <!-- Penilaian Kegiatan Pembelajaran 3 -->
                            @if($hasKegiatanPembelajaran3)
                                <div class="row">
                                    <div class="col">
                                        <div class="card text-center">
                                            <h5 class="card-header">
                                                Penilaian Kegiatan Pembelajaran 3
                                            </h5>
                                            <div class="card-body">
                                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="aspek" value="upload_file_pembelajaran3">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                                            required aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm"
                                                            value="{{ $nilaiUploadKegiatanPembelajaran3->nilai_akhir ?? '' }}" {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>
                                                    </div>
                                                    <label for="feedbackIndividu">Feedback</label><br>
                                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                                        id="feedbackIndividu" rows="5" {{ $nilaiUploadKegiatanPembelajaran3 ? 'disabled' : '' }}>
                                            {{ $nilaiUploadKegiatanPembelajaran3->data_jawaban_penilai ?? '' }}
                                        </textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Kirim</button>
                                                </form>
                                            </div>
                                            <div class="card-footer text-muted">
                                                Semangat dalam menilai!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Penilaian Aktivitas 1 -->
                            @if($hasAktivitas1)
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card text-center">
                                            <h5 class="card-header">
                                                Penilaian Kegiatan Aktivitas 1
                                            </h5>
                                            <div class="card-body">
                                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="aspek" value="upload_file_aktivitas1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                                            required aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm"
                                                            value="{{ $nilaiUploadAktivitas1->nilai_akhir ?? '' }}" {{ $nilaiUploadAktivitas1 ? 'disabled' : '' }}>
                                                    </div>
                                                    <label for="feedbackIndividu">Feedback</label><br>
                                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                                        id="feedbackIndividu" rows="5" {{ $nilaiUploadAktivitas1 ? 'disabled' : '' }}>
                                            {{ $nilaiUploadAktivitas1->data_jawaban_penilai ?? '' }}
                                        </textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Kirim</button>
                                                </form>
                                            </div>
                                            <div class="card-footer text-muted">
                                                Semangat dalam menilai!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Penilaian Aktivitas 2 -->
                            @if($hasAktivitas2)
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card text-center">
                                            <h5 class="card-header">
                                                Penilaian Kegiatan Aktivitas 2
                                            </h5>
                                            <div class="card-body">
                                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="aspek" value="upload_file_aktivitas2">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                                            required aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm"
                                                            value="{{ $nilaiUploadAktivitas2->nilai_akhir ?? '' }}" {{ $nilaiUploadAktivitas2 ? 'disabled' : '' }}>
                                                    </div>
                                                    <label for="feedbackIndividu">Feedback</label><br>
                                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                                        id="feedbackIndividu" rows="5" {{ $nilaiUploadAktivitas2 ? 'disabled' : '' }}>
                                            {{ $nilaiUploadAktivitas2->data_jawaban_penilai ?? '' }}
                                        </textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Kirim</button>
                                                </form>
                                            </div>
                                            <div class="card-footer text-muted">
                                                Semangat dalam menilai!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Penilaian Proyek Individu -->
                            @if($hasProyekIndividu)
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card text-center">
                                            <h5 class="card-header">
                                                Penilaian Proyek Individu
                                            </h5>
                                            <div class="card-body">
                                                <form action="{{ route('kirimJawabanIndividu', ['email' => $email]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="aspek" value="upload_file_proyekIndividu">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                                                        <input type="number" class="form-control" name="nilai_akhir" min="0" max="100"
                                                            required aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-sm"
                                                            value="{{ $nilaiUploadProyekIndividu->nilai_akhir ?? '' }}" {{ $nilaiUploadProyekIndividu ? 'disabled' : '' }}>
                                                    </div>
                                                    <label for="feedbackIndividu">Feedback</label><br>
                                                    <textarea class="form-control w-100 mt-2" name="data_jawaban_penilai"
                                                        id="feedbackIndividu" rows="5" {{ $nilaiUploadProyekIndividu ? 'disabled' : '' }}>
                                            {{ $nilaiUploadProyekIndividu->data_jawaban_penilai ?? '' }}
                                        </textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Kirim</button>
                                                </form>
                                            </div>
                                            <div class="card-footer text-muted">
                                                Semangat dalam menilai!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

            @endif
        </div>

    </div>
</div>
@endsection