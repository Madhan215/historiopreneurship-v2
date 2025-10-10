@extends('layouts.main')

@section('container-content')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <div class="">
        <div class="row">
            <div class="col">
                <h2>Data Nilai</h2>
                <p>Tempat untuk menilai tugas yang dikerjakan oleh mahasiswa</p>

                <!-- Dropdown untuk filter kelas dengan ukuran lebih kecil -->
                <label for="filterKelas">Filter Kode Kelas: </label>
                <select id="filterKelas" class="form-control form-control-sm mb-3" style="width: 150px;">
                    <option value="">Semua</option>
                    @foreach ($kelasGuru as $token)
                        <option value="{{ $token }}">{{ $token }}</option>
                    @endforeach
                </select>

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
                                    <th scope="col">Kode Kelas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($Mahasiswas as $Mahasiswa)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $Mahasiswa->nama_lengkap }}</td>
                                        <td>
                                            @foreach ($Mahasiswa->token_kelas ?? [] as $token)
                                                {{ $token['kode'] ?? '-' }} <br>
                                            @endforeach
                                        </td>
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
                        @if ($kelompokData->isEmpty())
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
                                                    <th scope="row" rowspan="{{ $rowspan }}">Kelompok
                                                        {{ $kelompokId }}</th>
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
        $(document).ready(function() {
            // Inisialisasi DataTable dengan penomoran otomatis pada kolom pertama
            var table = $('#tableNilai').DataTable({
                "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    } // Kolom 0 adalah kolom "Nomor"
                ],
                "order": [
                    [1, 'asc']
                ], // Mengurutkan berdasarkan kolom "Nama Mahasiswa"
                "drawCallback": function(settings) {
                    var api = this.api();
                    // Mulai penomoran dari 1 untuk setiap draw
                    api.column(0, {
                        order: 'applied',
                        search: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });

            // Event listener untuk dropdown filter kelas
            $('#filterKelas').on('change', function() {
                var selectedValue = $(this).val();
                table.column(2).search(selectedValue).draw(); // Kolom ketiga (index 2) adalah kolom "Kelas"
            });
        });
    </script>
@endsection
