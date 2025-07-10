@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

<div class="">
    <div class="row">
        <div class="col">
            <h2>Data Kelas</h2>
            <p>Menampilkan data kelas A1 dan A2, jumlah orang, nilai rata-rata, jumlah laki-laki perempuan</p>
            <table class="table text-center" id="tablekelas">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jumlah Mahasiswa</th>
                        <th scope="col">Jumlah Laki-Laki</th>
                        <th scope="col">Jumlah Perempuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>A1</td>
                        <td>{{ $totalKelasA1 }}</td>
                        <td>{{ $jumlahLakiA1 }}</td>
                        <td>{{ $jumlahPerempuanA1 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>A2</td>
                        <td>{{ $totalKelasA2 }}</td>
                        <td>{{ $jumlahLakiA2 }}</td>
                        <td>{{ $jumlahPerempuanA2 }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('export.kelas') }}" class="btn btn-primary">Export</a>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tablekelas').DataTable();
    });
</script>
@endsection