@extends('layouts.main')

@section('container-content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4>Edit Konten</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('manajemen-konten.update', $manajemen_konten->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Kategori:</label>
                        <select name="kategori_konten" class="form-select">
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ $kat == $manajemen_konten->kategori_konten ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Urut:</label>
                        <input type="number" name="nomor" class="form-control" value="{{ $manajemen_konten->nomor }}">
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


                    @if ($isGambar)
                        <div class="mb-3">
                            <label class="form-label">Gambar Baru :</label>
                            <input type="file" name="gambar" class="form-control">

                            <div class="mt-2">
                                <label class="form-label">Gambar Saat Ini:</label>
                                {!! $manajemen_konten->konten !!}
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Konten Teks / Caption:</label>
                        <textarea name="konten_teks" rows="5" class="form-control">{{ old('konten_teks', $caption) }}</textarea>
                    </div>


                    <div class="d-flex justify-content-between">
                        <a href="{{ route('manajemen-konten.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection