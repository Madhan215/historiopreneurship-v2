@extends('layouts.main')

@section('container-content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

<div class="container">
    <h2>Jawaban Refleksi Individu</h2>
    <h4 class="mb-4">Nama : {{$user->nama_lengkap}}</h4>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="refleksi-kesejarahan-tab" data-bs-toggle="tab" data-bs-target="#refleksi-kesejarahan"
                type="button" role="tab" aria-controls="refleksi-kesejarahan" aria-selected="true">Refleksi Kesejarahan</button>
        </li>
        <!-- Add a new tab for Analisis Kesejarahan II -->
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="refleksi-kewirausahaan-tab" data-bs-toggle="tab" data-bs-target="#refleksi-kewirausahaan"
                type="button" role="tab" aria-controls="refleksi-kewirausahaan" aria-selected="false">Refleksi Kewirausahaan</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="refleksi-kepariwisataan-tab" data-bs-toggle="tab" data-bs-target="#refleksi-kepariwisataan"
                type="button" role="tab" aria-controls="refleksi-kepariwisataan" aria-selected="false">Refleksi Kepariwisataan</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Refleksi Kesejarahan -->
        <div class="tab-pane fade  show active" id="refleksi-kesejarahan" role="tabpanel" aria-labelledby="refleksi-kesejarahan-tab">
            <h3 class="mt-3">Jawaban Refleksi Kejarahan</h3>
            @if($refleksiKesejarahan->isEmpty())
                <p>Siswa belum menjawab refleksi kesejarahan.</p>
            @else
            <div class="d-flex justify-content-center align-items-center mb-3">
                <table>
                    <tr>
                        @foreach(array_reverse(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas']) as $key => $value)
                            <td class="p-2">
                                <i id="icon-{{ $key }}" 
                                    class="fa-solid fa-face-{{ 
                                        $value == 'sangat puas' ? 'laugh-beam' : 
                                        ($value == 'puas' ? 'smile' : 
                                        ($value == 'biasa saja' ? 'grin-beam-sweat' : 
                                        ($value == 'kurang puas' ? 'sad-cry' : 'dizzy'))) }} {{ $refleksiKesejarahan[0]->respon == $value ? 'text-primary' : '' }} fs-1 icon"></i>
                            </td>
                        @endforeach
                    </tr>
                </table>  
            </div>
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Apa yang sudah kalian pelajari?</td>
                            <td>{{ $refleksiKesejarahan[0]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>AApa yang kalian kuasai dari materi ini?</td>
                            <td>{{ $refleksiKesejarahan[1]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Bagian apa yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKesejarahan[2]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Apa upaya kalian untuk menguasai yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKesejarahan[3]->jawaban }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Refleksi Kewirausahaan -->
        <div class="tab-pane fade" id="refleksi-kewirausahaan" role="tabpanel" aria-labelledby="refleksi-kewirausahaan-tab">
            <h3 class="mt-3">Jawaban Kesejarahan</h3>
            @if($refleksiKewirausahaan->isEmpty())
                <p>Siswa belum menjawab refleksi kewirausahaan.</p>
            @else
            <div class="d-flex justify-content-center align-items-center mb-3">
                <table>
                    <tr>
                        @foreach(array_reverse(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas']) as $key => $value)
                            <td class="p-2">
                                <i id="icon-{{ $key }}" 
                                    class="fa-solid fa-face-{{ 
                                        $value == 'sangat puas' ? 'laugh-beam' : 
                                        ($value == 'puas' ? 'smile' : 
                                        ($value == 'biasa saja' ? 'grin-beam-sweat' : 
                                        ($value == 'kurang puas' ? 'sad-cry' : 'dizzy'))) }} {{ $refleksiKewirausahaan[0]->respon == $value ? 'text-primary' : '' }} fs-1 icon"></i>
                            </td>
                        @endforeach
                    </tr>
                </table>  
            </div>
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Apa yang sudah kalian pelajari?</td>
                            <td>{{ $refleksiKewirausahaan[0]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>AApa yang kalian kuasai dari materi ini?</td>
                            <td>{{ $refleksiKewirausahaan[1]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Bagian apa yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKewirausahaan[2]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Apa upaya kalian untuk menguasai yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKewirausahaan[3]->jawaban }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>



        <!-- Refleksi Kepariwisataan -->
        <div class="tab-pane fade" id="refleksi-kepariwisataan" role="tabpanel" aria-labelledby="refleksi-kepariwisataan-tab">
            <h3 class="mt-3">Jawaban Kepariwisataan</h3>
            @if($refleksiKepariwisataan->isEmpty())
                <p>Siswa belum menjawab refleksi Kepariwisataan.</p>
            @else
            <div class="d-flex justify-content-center align-items-center mb-3">
                <table>
                    <tr>
                        @foreach(array_reverse(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas']) as $key => $value)
                            <td class="p-2">
                                <i id="icon-{{ $key }}" 
                                    class="fa-solid fa-face-{{ 
                                        $value == 'sangat puas' ? 'laugh-beam' : 
                                        ($value == 'puas' ? 'smile' : 
                                        ($value == 'biasa saja' ? 'grin-beam-sweat' : 
                                        ($value == 'kurang puas' ? 'sad-cry' : 'dizzy'))) }} {{ $refleksiKepariwisataan[0]->respon == $value ? 'text-primary' : '' }} fs-1 icon"></i>
                            </td>
                        @endforeach
                    </tr>
                </table>  
            </div>
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Apa yang sudah kalian pelajari?</td>
                            <td>{{ $refleksiKepariwisataan[0]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>AApa yang kalian kuasai dari materi ini?</td>
                            <td>{{ $refleksiKepariwisataan[1]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Bagian apa yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKepariwisataan[2]->jawaban }}</td>
                        </tr>
                        <tr>
                            <td>Apa upaya kalian untuk menguasai yang belum kalian kuasai?
                            </td>
                            <td>{{ $refleksiKepariwisataan[3]->jawaban }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
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