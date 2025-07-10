@extends('layouts.main')

@section('container-content')
<div class="content">
    <h4 class="mb-4">Nama : {{$user->nama_lengkap}}</h4>
    <hr>
    <h3 class="mb-3 text-center">Nilai Pre Test dan Post Test</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aspek</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if($nilaiPreTestKesejarahan)
                    <td>Pre Test Kesejarahan</td>
                    <td>{{ $nilaiPreTestKesejarahan->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Pre Test Kesejarahan</td>
                    @endif
                </tr>
                <tr>
                    @if($nilaiPostTestKesejarahan)
                    <td>Post Test Kesejarahan</td>
                    <td>{{ $nilaiPostTestKesejarahan->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Post Test Kesejarahan</td>
                    @endif
                </tr>
                <tr>
                    @if($nilaiPreTestKWU)
                    <td>Pre Test KWU & Kepariwisataan</td>
                    <td>{{ $nilaiPreTestKWU->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Pre Test KWU & Kepariwisataan</td>
                    @endif
                </tr>
                <tr>
                    @if($nilaiPostTestKWU)
                    <td>Post Test KWU & Kepariwisataan</td>
                    <td>{{ $nilaiPostTestKWU->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Post Test KWU & Kepariwisataan</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="mb-3 text-center">Nilai Kuis Drag n Drop</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aspek</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if($nilaiDNDKesejarahan)
                    <td>Nilai Kuis Drag n Drop Kesejarahan</td>
                    <td>{{ $nilaiDNDKesejarahan->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Kuis Drag n Drop Kesejarahan</td>
                    @endif
                </tr>
                <tr>
                    @if($nilaiDNDKWU)
                    <td>Nilai Kuis Drag n Drop KWU & Kepariwisataan</td>
                    <td>{{ $nilaiDNDKWU->nilai_akhir }}</td>
                    @else
                    <td colspan="2">Mahasiswa Belum Mengerjakan Kuis Drag n Drop KWU & Kepariwisataan </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
