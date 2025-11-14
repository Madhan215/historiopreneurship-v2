@extends('layouts.main')

@section('container-content')

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

    <style>
        /* === Tabel & Layout === */
        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table.dataTable {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
        }

        table.dataTable th,
        table.dataTable td {
            text-align: center !important;
            vertical-align: middle;
            white-space: normal !important;
            word-wrap: break-word !important;
            padding: 10px;
        }

        .card-body {
            overflow-x: auto;
        }

        /* Lebar kolom tabel Nilai */
        th:nth-child(1) {
            width: 5%;
        }

        th:nth-child(2) {
            width: 20%;
        }

        th:nth-child(3) {
            width: 25%;
        }

        th:nth-child(4) {
            width: 35%;
        }

        th:nth-child(5) {
            width: 15%;
        }

        /* Header Section */
        h2 {
            font-weight: 700;
        }

        .nav-tabs .nav-link {
            font-weight: 600;
        }

        .filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>

    <div class="container py-4">
        <div class="row">
            <div class="col">
                <h2 class="fw-bold mb-2">Data Nilai</h2>
                <p class="text-muted">Tempat untuk menilai dan memantau hasil tugas mahasiswa</p>

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="nilaiTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload"
                            type="button" role="tab" aria-controls="upload" aria-selected="true">
                            <i class="fas fa-upload me-2"></i> File Upload
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hasil-tab" data-bs-toggle="tab" data-bs-target="#hasil" type="button"
                            role="tab" aria-controls="hasil" aria-selected="false">
                            <i class="fas fa-list-check me-2"></i> Hasil Nilai
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="nilaiTabsContent">

                    <!-- ================= TAB UPLOAD ================= -->
                    <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        @if ($Mahasiswas->isEmpty())
                            <div class="alert alert-warning text-center mt-4">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Tidak ada mahasiswa ditemukan.
                            </div>
                        @else
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <table class="table table-bordered table-hover text-center align-middle w-100"
                                        id="tableNilai">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
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
                                                            <i class="fas fa-pen me-1"></i> Nilai
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- ================= TAB HASIL NILAI ================= -->
                    <div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="hasil-tab">
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-3 flex-wrap gap-2">
                            <h4 class="fw-bold mb-0">Hasil Keseluruhan Nilai</h4>

                            <div class="filter-container">
                                <label for="filterTipe" class="fw-semibold mb-0">Filter tipe:</label>

                                <select id="filterTipe" class="form-select form-select-sm" style="width:180px;">
                                    <option value="">Semua</option>
                                    <option value="evaluasi">Evaluasi</option>
                                    <option value="upload">Upload</option>

                                    <!-- Tambahan baru -->
                                    <option value="proyek_individu">proyek_individu_kewirausahaan</option>
                                </select>

                                <button id="exportExcelBtn" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel me-1"></i> Export Nilai
                                </button>
                            </div>

                        </div>

                        @if ($dataNilai->isEmpty())
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Belum ada data nilai yang tersimpan.
                            </div>
                        @else
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <table class="table table-bordered table-hover align-middle text-center w-100"
                                        id="tableHasil">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Aspek</th>
                                                <th>Nilai Akhir</th>
                                                <th style="display:none;">Tipe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataNilai as $n)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $n->nama_lengkap ?? '-' }}</td>
                                                    <td>{{ $n->email }}</td>
                                                    <td>{{ $n->aspek }}</td>
                                                    <td><strong>{{ $n->nilai_akhir }}</strong></td>
                                                    <td>{{ $n->tipe ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= SCRIPT ================= -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // === Table 1: Daftar Mahasiswa ===
            const table1 = $('#tableNilai').DataTable({
                columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
                order: [[1, 'asc']]
            });

            table1.on('order.dt search.dt', function () {
                table1.column(0, { search: 'applied', order: 'applied' }).nodes()
                    .each((cell, i) => { cell.innerHTML = i + 1; });
            }).draw();

            // === Table 2: Hasil Nilai ===
            const table2 = $('#tableHasil').DataTable({
                order: [[1, 'asc']],
                autoWidth: false,
                columnDefs: [{ targets: 5, visible: false }]
            });

            table2.on('order.dt search.dt', function () {
                table2.column(0, { search: 'applied', order: 'applied' }).nodes()
                    .each((cell, i) => { cell.innerHTML = i + 1; });
            }).draw();

            // === Filter berdasarkan tipe ===
            $('#filterTipe').on('change', function () {
                let value = $(this).val();
                if (value === 'upload') value = 'file_upload'; // ubah value agar sesuai DB
                table2.column(5).search(value).draw();
            });

            // Tambahkan jarak pada search bar bawaan DataTables
            $('.dataTables_filter').addClass('mb-3');

            // === Export Excel ===
            $('#exportExcelBtn').on('click', function () {
                let tipe = $('#filterTipe').val();
                if (tipe === 'upload') tipe = 'file_upload'; // ubah agar sesuai backend
                let url = "{{ route('exportNilaiExcel') }}";
                if (tipe) url += '?tipe=' + tipe;
                window.location.href = url;
            });
        });
    </script>

@endsection