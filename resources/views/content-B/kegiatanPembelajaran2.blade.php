@extends('layouts.main')

@section('container-content')

    <h2>Kegiatan Pembelajaran 2</h2>
    <p class="text-sm">6 JP x @50 menit = 300 menit</p>
    <p>
        <b>CPMK:</b>
    </p>
    <ol>
        @foreach ($contents as $konten)
            {!! $konten->konten !!}
        @endforeach
    </ol>
    <div class="border rounded bg-warning-subtle p-2">
        Untuk dapat mencapai Kegiatan Pembelajaran 2, silahkan eksplorasi lebih lanjut terkait kesejarahan yang ada di
        Kalimantan Selatan. Dan kerjakan analisi yang ada pada halaman selanjutnya >>
    </div>

@endsection