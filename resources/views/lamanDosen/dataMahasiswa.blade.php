@extends('layouts.main')

@section('container-content')

<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="">
    <div class="row">
        <div class="col">
            <h2>Data Mahasiswa</h2>
            <p>Menampilkan data mahasiswa keseluruhan, bisa di filter berdasarkan kelas</p>

            <!-- Dropdown untuk filter kelas dengan ukuran lebih kecil -->
            <label for="filterKelas">Filter Kelas: </label>
            <select id="filterKelas" class="form-control form-control-sm mb-3" style="width: 150px;">
                <option value="">Semua</option>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
            </select>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="aturKelompok-tab" data-bs-toggle="tab"
                        data-bs-target="#aturKelompok" type="button" role="tab" aria-controls="aturKelompok"
                        aria-selected="true">Atur Kelompok</button>
                </li>
                @php
                    // Mencari id_kelompok maksimal dari data yang ada
                    $maxKelompokId = $Kelompoks->max('id_kelompok');
                @endphp
                @for ($i = 1; $i <= $maxKelompokId; $i++)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kelompok{{ $i }}-tab" data-bs-toggle="tab"
                            data-bs-target="#kelompok{{ $i }}" type="button" role="tab" aria-controls="kelompok{{ $i }}"
                            aria-selected="false">Kelompok {{ $i }}</button>
                    </li>
                @endfor
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="myTabContent">
                <!-- Tab Atur Kelompok -->
                <div class="tab-pane fade show active" id="aturKelompok" role="tabpanel"
                    aria-labelledby="aturKelompok-tab">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Daftar Mahasiswa</h4>
                        <form action="{{ route('dataMahasiswa.autoAssignGroup') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Masukkan Kelompok Otomatis</button>
                        </form>
                    </div>
                    <table class="table text-center mt-3" id="tabelMahasiswa">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach($Mahasiswas as $Mahasiswa)
                                                        @php
                                                            // Cek kelompok dari Kelompoks berdasarkan email mahasiswa
                                                            $kelompok = $Kelompoks->firstWhere('email', $Mahasiswa->email);
                                                        @endphp
                                                        <tr>
                                                            <th scope="row">{{ $no }}</th>
                                                            <td>{{ $Mahasiswa->nama_lengkap }}</td>
                                                            <td>{{ $Mahasiswa->kelas }}</td>
                                                            <td>{{ $Mahasiswa->email }}</td>
                                                            <td>
                                                                @if ($kelompok && !is_null($kelompok->id_kelompok))
                                                                    <!-- Jika mahasiswa sudah memiliki kelompok, tampilkan info kelompok -->
                                                                    <span>Kelompok {{ $kelompok->id_kelompok }}</span>
                                                                @else
                                                                    <!-- Jika mahasiswa belum memiliki kelompok, tampilkan tombol dropdown -->
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Masukkan Kelompok
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                            @for ($i = 1; $i <= 4; $i++)
                                                                                <li>
                                                                                    <form action="{{ route('dataMahasiswa.saveGroup') }}" method="POST"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        <input type="hidden" name="email" value="{{ $Mahasiswa->email }}">
                                                                                        <input type="hidden" name="id_kelompok" value="{{ $i }}">
                                                                                        <button type="submit" class="dropdown-item">{{ $i }}</button>
                                                                                    </form>
                                                                                </li>
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $no++;
                                                        @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @for ($i = 1; $i <= $maxKelompokId; $i++)
                                @php
                                    // Temukan semua pengguna dalam kelompok saat ini
                                    $kelompokUsers = $Kelompoks->where('id_kelompok', $i)->flatMap(function ($kelompok) {
                                        return $kelompok->users;
                                    });
                                @endphp
                                <div class="tab-pane fade" id="kelompok{{ $i }}" role="tabpanel" aria-labelledby="kelompok{{ $i }}-tab">
                                    <h4>Kelompok {{ $i }}</h4>
                                    @if ($kelompokUsers->isNotEmpty())
                                        <table class="table text-center mt-3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Mahasiswa</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelompokUsers as $Mahasiswa)
                                                    <tr>
                                                        <td>{{ $Mahasiswa->nama_lengkap }}</td>
                                                        <td>{{ $Mahasiswa->kelas }}</td>
                                                        <td>{{ $Mahasiswa->email }}</td>
                                                        <td>
                                                            <!-- Di bagian dropdown pada tab Kelompok -->
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Ubah Kelompok
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                    @for ($j = 1; $j <= $maxKelompokId; $j++)
                                                                        @if ($j != $i) <!-- Hindari menugaskan ke kelompok saat ini -->
                                                                            <li>
                                                                                <form action="{{ route('dataMahasiswa.saveGroup') }}" method="POST"
                                                                                    style="display: inline;">
                                                                                    @csrf
                                                                                    <input type="hidden" name="email" value="{{ $Mahasiswa->email }}">
                                                                                    <input type="hidden" name="id_kelompok" value="{{ $j }}">
                                                                                    <button type="submit" class="dropdown-item">{{ $j }}</button>
                                                                                </form>
                                                                            </li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                            <div class="btn-group ms-2" role="group">
                                                                <!-- Tombol untuk mengeluarkan dari kelompok -->
                                                                <form action="{{ route('dataMahasiswa.removeFromGroup') }}" method="POST"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    <input type="hidden" name="email" value="{{ $Mahasiswa->email }}">
                                                                    <button type="submit" class="btn btn-danger" title="Keluar dari Kelompok">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>Tidak ada mahasiswa di kelompok ini.</p>
                                    @endif
                                </div>
                @endfor

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi DataTable dengan penomoran otomatis pada kolom pertama
            var table = $('#tabelMahasiswa').DataTable({
                "columnDefs": [
                    { "searchable": false, "orderable": false, "targets": 0 } // Kolom 0 adalah kolom "Nomor"
                ],
                "order": [[1, 'asc']], // Mengurutkan berdasarkan kolom "Nama Mahasiswa"
                "drawCallback": function (settings) {
                    var api = this.api();
                    // Mulai penomoran dari 1 untuk setiap draw
                    api.column(0, { order: 'applied', search: 'applied' }).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });

            // Event listener untuk dropdown filter kelas
            $('#filterKelas').on('change', function () {
                var selectedValue = $(this).val();
                table.column(2).search(selectedValue).draw(); // Kolom ketiga (index 2) adalah kolom "Kelas"
            });
        });
    </script>

    @endsection