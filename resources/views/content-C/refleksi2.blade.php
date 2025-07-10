@extends('layouts.main')

@section('container-content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2>Refleksi C. 2</h2>
<p>
    Setelah mempelajari materi ini, bagaimana pemahaman kalian terhadap materi? Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar-benarnya sesuai dengan perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi ini!
</p>
<div class="d-flex justify-content-center align-items-center mb-3">
<form action="{{ route('simpanRefleksiKewirausahaan') }}" method="POST">
    @csrf
        <input type="hidden" name="kategori" value="refleksi kepariwisataan">
    <table>
        <tr>
            @foreach(array_reverse(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas']) as $key => $value)
                <td class="p-2">
                    <i id="icon-{{ $key }}" 
                    class="fa-solid fa-face-{{ 
                        $value == 'sangat puas' ? 'laugh-beam' : 
                        ($value == 'puas' ? 'smile' : 
                        ($value == 'biasa saja' ? 'grin-beam-sweat' : 
                        ($value == 'kurang puas' ? 'sad-cry' : 'dizzy'))) }} fs-1 icon"></i>
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach(array_reverse(['sangat puas', 'puas', 'biasa saja', 'kurang puas', 'sangat kurang puas']) as $key => $value)
                <td class="text-center">
                    <input 
                        id="radio-{{ $key }}" 
                        class="form-check-input" 
                        type="radio" 
                        name="respon" 
                        value="{{ $value }}" 
                        {{ old('respon', $jawabanRefleksi->get('refleksi kepariwisataan', collect())->get('sudah dipelajari')->respon ?? '') == $value ? 'checked' : '' }}>
                </td>
            @endforeach
        </tr>
    </table>
</div>


    <p><b>Jawablah pertanyaan berikut!</b></p>
    <div class="row mt-3">
        <ol>
            <li class="mt-3">
                <label for="sudah_dipelajari" class="fw-semibold">Apa yang sudah kalian pelajari?</label> <br>
                <textarea class="form-control w-100 mt-2" name="sudah_dipelajari" id="sudah_dipelajari"
                    rows="5">{{ old('sudah_dipelajari', $jawabanRefleksi->get('refleksi kepariwisataan', collect())->get('sudah dipelajari')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="dikuasai" class="fw-semibold">Apa yang kalian kuasai dari materi ini?</label> <br>
                <textarea class="form-control w-100 mt-2"  name="dikuasai" id="dikuasai"
                    rows="5">{{ old('dikuasai', $jawabanRefleksi->get('refleksi kepariwisataan', collect())->get('dikuasai')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="belum_dikuasai" class="fw-semibold">Bagian apa yang belum kalian kuasai?</label> <br>
                <textarea class="form-control w-100 mt-2"  name="belum_dikuasai" id="belum_dikuasai"
                    rows="5">{{ old('belum_dikuasai', $jawabanRefleksi->get('refleksi kepariwisataan', collect())->get('belum dikuasai')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="upaya_menguasai" class="fw-semibold">Apa upaya kalian untuk menguasai yang belum kalian
                    kuasai?</label>
                <br>
                <textarea class="form-control w-100 mt-2" name="upaya_menguasai" id="upaya_menguasai"
                    rows="5">{{ old('upaya_menguasai', $jawabanRefleksi->get('refleksi kepariwisataan', collect())->get('upaya untuk menguasai')->jawaban ?? '') }}</textarea>
            </li>
        </ol>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const radios = document.querySelectorAll('input[name="respon"]');
    const icons = document.querySelectorAll('.icon');

    // Fungsi untuk memperbarui ikon berdasarkan radio yang diceklis
    const updateIcons = () => {
        // Hapus kelas 'text-primary' dari semua ikon
        icons.forEach(icon => icon.classList.remove('text-primary'));

        // Tambahkan kelas 'text-primary' ke ikon yang sesuai dengan radio yang diceklis
        radios.forEach((radio, index) => {
            if (radio.checked) {
                icons[index].classList.add('text-primary');
            }
        });
    };

    // Jalankan fungsi saat halaman dimuat untuk sinkronisasi awal
    updateIcons();

    // Tambahkan event listener ke setiap radio button
    radios.forEach(radio => {
        radio.addEventListener('change', updateIcons);
    });
});

@endsection