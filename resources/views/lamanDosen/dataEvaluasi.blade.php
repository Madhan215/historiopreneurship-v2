@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
<div class="">
    <div class="row">
        <div class="col">
            <h2>Progress Belajar</h2>
            <p>Menampilkan data hasil Evaluasi, dosen dapat melakukan export dan menggunakan data table</p>
            <table class="table text-center" id="dataEvaluasiTable">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nilai Evaluasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($mahasiswa as $data)
                                        <tr>
                                            <th scope="row">{{ $no }}</th>
                                            <td>{{ $data->nama_lengkap }}</td>
                                            <td>{{ $data->kelas }}</td>
                                            <td>{{ $data->nilai_akhir }}</td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                    @endforeach

                </tbody>
            </table>
            <a href="{{ route('export.evaluasi') }}" class="btn btn-primary">Export</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataEvaluasiTable').DataTable();
    });
</script>
@endsection