@extends('layouts.main')

@section('container-content')

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <div class="">
        <div class="row">
            <div class="col">
                <h2>Data Nilai</h2>
                <p>Tempat untuk menilai tugas yang dikerjakan oleh mahasiswa</p>
                <!-- Tab Navigasi -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="individu-tab" data-bs-toggle="tab" data-bs-target="#individu"
                            type="button" role="tab" aria-controls="individu" aria-selected="true">
                            File Upload
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hasil-tab" data-bs-toggle="tab" data-bs-target="#hasil" type="button"
                            role="tab" aria-controls="hasil" aria-selected="false">
                            Hasil
                        </button>
                    </li>
                </ul>

                <!-- Konten Tab -->
                <div class="tab-content mt-3" id="myTabContent">
                    <!-- Tab Individu -->
                    <div class="tab-pane fade show active" id="individu" role="tabpanel" aria-labelledby="individu-tab">

                        @if ($Mahasiswas->isEmpty())
                            <div class="alert alert-warning text-center mt-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Tidak ada mahasiswa ditemukan.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped text-center align-middle" id="tableNilai">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 5%">Nomor</th>
                                            <th>Nama</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Mahasiswas as $Mahasiswa)
                                            <tr>
                                                <td></td>
                                                <td>{{ $Mahasiswa->nama_lengkap ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('dataJawabanIndividu', ['email' => $Mahasiswa->email]) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-pen"></i> Nilai
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- Tab Hasil -->
                    <div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="hasil-tab">
                        <h4>Hasil Keseluruhan</h4>
                        <p class="text-muted">Fitur hasil keseluruhan akan ditambahkan di sini nanti.</p>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- Script DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script> $(document).ready(
            function () {
                var table = $('#tableNilai').DataTable({ columnDefs: [{ searchable: false, orderable: false, targets: 0 }], order: [[1, 'asc']] });
                table.on('order.dt search.dt', function () { let i = 1; table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function () { this.data(i++); }); }).draw(); 
                $('.dataTables_filter').addClass('mb-3');
            }); </script>

@endsection