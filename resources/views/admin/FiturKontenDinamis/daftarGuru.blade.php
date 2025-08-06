@extends('layouts.main')

@section('container-content')
    <h2 class="mb-4 fw-bold">Daftar Guru dan Kelas yang Diampu</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>Kelas yang Diampu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guruList as $index => $guru)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $guru->nama_lengkap }}</td>
                    <td>{{ $guru->email }}</td>
                    <td>
                        @if (!empty($guru->kelas))
                            <ul class="mb-0">
                                @foreach ($guru->kelas as $kelasId => $token)
                                    <li>
                                        Kelas ID: {{ $kelasId }} |
                                        Token:
                                        <a href="{{ route('topik.index', ['token_kelas' => $token]) }}">
                                            <code>{{ $token }}</code>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        @else
                            <em>Tidak ada kelas</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data guru</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection