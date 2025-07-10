@extends('layouts.main')

@section('container-content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
<div class="">
    <div class="row">
        <div class="col">
            <h2>Data Nilai Test & Kuis</h2>
            <p>Tempat melihat nilai Pre Test dan Post Test serta Kuis yang dikerjakan oleh mahasiswa</p>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="individu-tab" data-bs-toggle="tab" data-bs-target="#individu"
                        type="button" role="tab" aria-controls="individu" aria-selected="true">Individu</button>
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
                                                            <td>
                                                                <a href="{{ route('dataJawabanTest', ['email' => $Mahasiswa->email]) }}"
                                                                    class="btn btn-success">Lihat</a>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $no++;
                                                        @endphp
                            @endforeach
                        </tbody>
                    </table>
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