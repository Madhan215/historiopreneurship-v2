@extends('layouts.main')

@section('container-content')
<div class="content">
    @if($hasData)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aspek</th>
                    <th>Jawaban Penilai</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataNilai as $nilai)
                <tr>
                    <td>
                        {{ 
                            $nilai->aspek == 'analisa_individu_kesejarahan_II' ? 'Analisis Kelompok Kesejarahan' :
                            ($nilai->aspek == 'analisa_individu_kesejarahan' ? 'Analisis Individu Kesejarahan' :
                            ($nilai->aspek == 'analisa_individu_kewirausahaan' ? 'Proyek Individu KWU' : $nilai->aspek))
                        }}
                    </td>
                    <td>{{ $nilai->data_jawaban_penilai }}</td>
                    <td>{{ $nilai->nilai_akhir }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informasi</h5>
            <p class="card-text">Tugas Anda belum dinilai.</p>
        </div>
    </div>
    @endif
</div>
@endsection
