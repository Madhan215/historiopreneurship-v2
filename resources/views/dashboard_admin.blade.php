@extends('layouts.main')

@section('container')

    <div class="mt-3">
        <div class="row">
            <div class="col-md-10">
                <h1 class="text-center">Dashboard Admin</h1>
                <h3>Tabel Data Pengguna</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n= 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>

                            {{-- Pembeda peran --}}
                            @if ($user->peran == 'admin')
                                <td>Admin</td>
                            @elseif ($user->peran == 'guru')
                                <td>Guru</td>
                            @else
                                <td>Siswa</td>
                            @endif
                        </tr>
                        @php
                            $n++;
                        @endphp
                        @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    {{-- JavaScript Local --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

@endsection