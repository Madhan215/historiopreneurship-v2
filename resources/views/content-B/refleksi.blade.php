@extends('layouts.main')

@section('container-content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<h2>Refleksi B.</h2>
<p>
    Setelah mempelajari materi ini, bagaimana pemahaman kalian terhadap materi? Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar-benarnya sesuai dengan perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi ini!
</p>
<div class="d-flex justify-content-center align-items-center mb-3">
    <form method="post" action="{{ route('simpanRefleksiKesejarahan') }}">
        @csrf
        <input type="hidden" name="kategori" value="refleksi kesejarahan">
    <table>
        
        <tr>
            <td class="p-2"><i class="fa-solid fa-face-smile fs-1 icon"></i></td>
            <td class="p-2"><i class="fa-solid fa-face-grin-beam-sweat fs-1 icon"></i></td>
            <td class="p-2"><i class="fa-solid fa-face-laugh-beam fs-1 icon"></i></td>
            <td class="p-2"><i class="fa-solid fa-face-sad-cry fs-1 icon"></i></td>
            <td class="p-2"><i class="fa-solid fa-face-dizzy fs-1 icon"></i></td>
        </tr>
        <tr>
            <td class="text-center"><input class="form-check-input" type="radio" value="sangat puas" name="respon" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == 'sangat puas' ? 'checked' : '' }}></td>
            <td class="text-center"><input class="form-check-input" type="radio" value="puas" name="respon" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == 'puas' ? 'checked' : '' }}></td>
            <td class="text-center"><input class="form-check-input" type="radio" value="biasa saja" name="respon" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == 'biasa saja' ? 'checked' : '' }}></td>
            <td class="text-center"><input class="form-check-input" type="radio" value="kurang puas" name="respon" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == 'kurang puas' ? 'checked' : '' }}></td>
            <td class="text-center"><input class="form-check-input" type="radio" value="sangat kurang puas" name="respon" {{ old('respon', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->respon ?? '') == 'sangat kurang puas' ? 'checked' : '' }}></td>
        </tr>
    </table>
</div>




    <p><b>Jawablah pertanyaan berikut!</b></p>
    <div class="row mt-3">
        <ol>
            <li class="mt-3">
                <label for="sudah_dipelajari" class="fw-semibold">Apa yang sudah kalian pelajari?</label> <br>
                <textarea class="form-control w-100 mt-2" name="sudah_dipelajari" id="sudah_dipelajari"
                    rows="5">{{ old('sudah_dipelajari', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('sudah dipelajari')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="dikuasai" class="fw-semibold">Apa yang kalian kuasai dari materi ini?</label> <br>
                <textarea class="form-control w-100 mt-2"  name="dikuasai" id="dikuasai"
                    rows="5">{{ old('dikuasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('dikuasai')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="belum_dikuasai" class="fw-semibold">Bagian apa yang belum kalian kuasai?</label> <br>
                <textarea class="form-control w-100 mt-2"  name="belum_dikuasai" id="belum_dikuasai"
                    rows="5">{{ old('belum_dikuasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('belum dikuasai')->jawaban ?? '') }}</textarea>
            </li>
            <li class="mt-3">
                <label for="upaya_menguasai" class="fw-semibold">Apa upaya kalian untuk menguasai yang belum kalian
                    kuasai?</label>
                <br>
                <textarea class="form-control w-100 mt-2" name="upaya_menguasai" id="upaya_menguasai"
                    rows="5">{{ old('upaya_menguasai', $jawabanRefleksi->get('refleksi kesejarahan', collect())->get('upaya untuk menguasai')->jawaban ?? '') }}</textarea>
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

</script>

@endsection