@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
<div class="">
    <div class="row">
        <div class="col">
            <h2>Data Nilai</h2>
            <p>Tempat untuk menilai tugas yang dikerjakan oleh mahasiswa</p>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="individu-tab" data-bs-toggle="tab" data-bs-target="#individu"
                        type="button" role="tab" aria-controls="individu" aria-selected="true">Individu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kelompok-tab" data-bs-toggle="tab" data-bs-target="#kelompok"
                        type="button" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="myTabContent">
                <!-- Tab Individu -->
                <div class="tab-pane fade show active" id="individu" role="tabpanel" aria-labelledby="individu-tab">
                    <table class="table text-center mt-3" id="tableNilai">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($Mahasiswas as $Mahasiswa)
                                                        <tr>
                                                            <th scope="row">{{ $no }}</th>
                                                            <td>{{ $Mahasiswa->nama_lengkap }}</td>
                                                            <td>{{ $Mahasiswa->kelas }}</td>
                                                            <td>Perlu Dinilai</td>
                                                            <td>
                                                                <a href="{{ route('dataJawabanIndividu', ['email' => $Mahasiswa->email]) }}"
                                                                    class="btn btn-success">Nilai</a>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $no++;
                                                        @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                    <!-- Tab Kelompok -->
                    @php
                        $kelompokData = $Kelompoks->whereNotNull('id_kelompok')->groupBy('id_kelompok')->sortKeys();
                    @endphp
                    @if($kelompokData->isEmpty())
                        <p>tidak ada kelompok yang mengumpulkan tugas</p>
                    @else
                    <table class="table text-center mt-3 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kelompok</th>
                                <th scope="col">Nama Siswa (Email)</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelompokData as $kelompokId => $kelompokGroup)
                                                        @php
                                                            $rowspan = $kelompokGroup->count();
                                                        @endphp
                                                        @foreach ($kelompokGroup as $index => $kelompok)
                                                            <tr>
                                                                @if ($index === 0)
                                                                    <!-- Menampilkan nomor kelompok hanya pada baris pertama anggota kelompok -->
                                                                    <th scope="row" rowspan="{{ $rowspan }}">Kelompok {{ $kelompokId }}</th>
                                                                    <td>{{ $kelompok->email }}</td>
                                                                    <td rowspan="{{ $rowspan }}">
                                                                        <!-- Update tombol untuk mengarah ke halaman kedua berdasarkan id_kelompok -->
                                                                        <a href="{{ route('dataJawabanKelompok', ['id_kelompok' => $kelompokId]) }}"
                                                                            class="btn btn-success">Nilai</a>
                                                                    </td>
                                                                @else
                                                                    <td>{{ $kelompok->email }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tableNilai').DataTable();
    });
</script>
@endsection