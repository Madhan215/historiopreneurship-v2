@extends('layouts.main')

@section('container-content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header">
            <h4>Edit Konten</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen-konten.update', $manajemen_konten->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kategori:</label>
                    <select name="kategori_konten" id="kategori_konten" class="form-select" disabled>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ $kat == $manajemen_konten->kategori_konten ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    {{-- hidden input untuk tetap mengirim kategori --}}
                    <input type="hidden" name="kategori_konten" value="{{ $manajemen_konten->kategori_konten }}">
                </div>

                @php
                    use Illuminate\Support\Str;

                    $isGambar = Str::contains($manajemen_konten->konten, '<img');

                    if ($isGambar) {
                        if (preg_match('/<figcaption.*?>(.*?)<\/figcaption>/s', $manajemen_konten->konten, $matches)) {
                            $caption = trim($matches[1]);
                        } else {
                            $caption = '';
                        }
                    } else {
                        $caption = strip_tags($manajemen_konten->konten);
                    }
                @endphp

                {{-- Gambar & Caption hanya jika kegiatanPembelajaran1 --}}
                <div id="gambarSection" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Gambar Baru:</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    @if ($isGambar)
                        <div class="mt-2">
                            <label class="form-label">Gambar Saat Ini:</label>
                            {!! $manajemen_konten->konten !!}
                        </div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="mb-3">
                    <label class="form-label" id="kontenLabel">Konten Teks:</label>
                    <textarea name="konten_teks" rows="5" class="form-control">{{ old('konten_teks', $caption) }}</textarea>
                    <small class="text-muted" id="kontenHint"></small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('manajemen-konten.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleSection() {
        const kategori = document.getElementById('kategori_konten').value;
        const gambarSection = document.getElementById('gambarSection');
        const kontenLabel = document.getElementById('kontenLabel');
        const kontenHint = document.getElementById('kontenHint');

        if (kategori === 'kegiatanPembelajaran1') {
            gambarSection.style.display = 'block';
            kontenLabel.innerText = 'Caption untuk Gambar:';
            kontenHint.innerText = 'Teks ini akan tampil di bawah gambar.';
        } else if (kategori === 'kegiatanPembelajaran2') {
            gambarSection.style.display = 'none';
            kontenLabel.innerText = 'Isi Teks List Item (<li>):';
            kontenHint.innerText = 'Teks akan otomatis dibungkus tag <li>.';
        } else {
            gambarSection.style.display = 'none';
            kontenLabel.innerText = 'Konten Teks:';
            kontenHint.innerText = '';
        }
    }

    toggleSection();
    document.getElementById('kategori_konten').addEventListener('change', toggleSection);
</script>
@endsection
