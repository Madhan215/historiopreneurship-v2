@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

<div class="">
    <div class="row">
        <div class="col">
            <h2>Data Nilai</h2>
            <p>Menampilkan data nilai dari berbagai 6 aspek</p>
            <table class="table text-center" id="tableNilai">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Pre Test Kesejarahan</th>
                        <th scope="col">Post Test Kesejarahan</th>
                        <th scope="col">Poin DND Kesejarahan</th>
                        <th scope="col">Pre Test KWU</th>
                        <th scope="col">Post Test KWU</th>
                        <th scope="col">Poin DND KWU</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $key => $data)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $data->nama_lengkap }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->pre_test_kesejarahan }}</td>
                            <td>{{ $data->post_test_kesejarahan }}</td>
                            <td>{{ $data->poin_DND_kesejarahan }}</td>
                            <td>{{ $data->pre_test_KWU }}</td>
                            <td>{{ $data->post_test_KWU }}</td>
                            <td>{{ $data->poin_DND_KWU }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('export.nilai') }}" class="btn btn-primary">Export</a>
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
