@extends('layouts.main')

@section('container-content')

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="">
        <div class="row">
            <div class="col">
                <h2>Data Mahasiswa</h2>
                <p>Menampilkan data mahasiswa yang berada dalam kelas aktif milik guru.</p>

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="aturKelompok-tab" data-bs-toggle="tab"
                            data-bs-target="#aturKelompok" type="button" role="tab" aria-controls="aturKelompok"
                            aria-selected="true">Daftar Mahasiswa</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="aturKelompok" role="tabpanel"
                        aria-labelledby="aturKelompok-tab">

                        @if($Mahasiswas->isEmpty())
                            <div class="alert alert-warning text-center mt-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Anda harus masuk kelas terlebih dahulu.
                            </div>
                        @else
                            <!-- Tombol Export Excel -->
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('exportMahasiswa') }}" class="btn btn-success">
                                    <i class="fas fa-file-excel me-1"></i> Export ke Excel
                                </a>
                            </div>

                            <table class="table text-center mt-3" id="tabelMahasiswa">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($Mahasiswas as $Mahasiswa)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $Mahasiswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $Mahasiswa->email }}</td>
                                        </tr>
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
            if ($('#tabelMahasiswa').length) {
                var table = $('#tabelMahasiswa').DataTable({
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    order: [[1, 'asc']],
                    drawCallback: function (settings) {
                        var api = this.api();
                        api.column(0, { order: 'applied', search: 'applied' }).nodes().each(function (cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }
                });
            }
        });
    </script>

@endsection