@extends('layouts.main')

@section('container-content')
<style>
    .card-custom {
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        border: none;
    }
    .table-hover tbody tr:hover {
        background-color: #f0f7ff !important;
    }
    .btn-save {
        border-radius: 0.6rem;
        padding: 6px 18px;
    }
    .top-action {
        position: absolute;
        top: 20px;
        right: 20px;
    }
</style>

<div class="container mt-4">

    <div class="card card-custom p-4 position-relative">

        <!-- 🔵 Tombol Atur Kelompok Otomatis di pojok kanan -->
        <div class="top-action">
            <form action="{{ route('autoKelompok') }}" method="POST">
                @csrf
                <button class="btn btn-success shadow-sm px-4 py-2 fw-bold">
                    🔄 Atur Otomatis
                </button>
            </form>
        </div>

        <h3 class="fw-bold text-primary mb-4 text-center">
            📘 Atur Kelompok Siswa
        </h3>

        @if(session('success'))
            <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center shadow-sm">{{ session('error') }}</div>
        @endif

        @if($siswa->isEmpty())

            <div class="alert alert-warning text-center mt-3">
                Tidak ada siswa pada kelas aktif ini.
            </div>

        @else

            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover shadow-sm align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width: 200px;">Pilih Kelompok</th>
                            <th style="width: 130px;">Aksi</th>
                            <th style="width: 160px;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($siswa as $i => $row)
                            @php
                                $kelompokSaatIni = $kelompokData[$row->email]->id_kelompok ?? null;
                            @endphp

                            <tr>
                                <td class="text-center fw-bold">{{ $i + 1 }}</td>
                                <td>{{ $row->nama_lengkap ?? $row->nama }}</td>
                                <td class="text-muted">{{ $row->email }}</td>

                                <td>
                                    <form action="{{ route('updateKelompok') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $row->email }}">

                                        <select name="id_kelompok" class="form-select form-select-sm" required>
                                            <option value="" disabled {{ $kelompokSaatIni ? '' : 'selected' }}>
                                                -- Pilih --
                                            </option>

                                            @for($k = 1; $k <= 4; $k++)
                                                <option value="{{ $k }}" {{ $kelompokSaatIni == $k ? 'selected' : '' }}>
                                                    Kelompok {{ $k }}
                                                </option>
                                            @endfor
                                        </select>
                                </td>

                                <td class="text-center">
                                        <button type="submit" class="btn btn-primary btn-save">
                                            Simpan
                                        </button>
                                    </form>
                                </td>

                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 py-2 
                                        {{ $kelompokSaatIni ? 'bg-info text-dark' : 'bg-secondary' }}">
                                        {{ $kelompokSaatIni ? "Kelompok $kelompokSaatIni" : "Belum masuk" }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @endif

    </div>

</div>
@endsection
