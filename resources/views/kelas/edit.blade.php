<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="max-width: 600px">
    <h3>Edit Kelas {{ $kelas->nama_kelas }}</h3>

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Kelas</label>
            <textarea name="deskripsi_kelas" class="form-control" rows="4">{{ $kelas->deskripsi_kelas }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">SIMPAN</button>
    </form>
</div>
</body>
</html>
