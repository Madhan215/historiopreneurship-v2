@extends('layouts.home')

@section('container')

<div class="p-5 p-sm-5 mb-5 mb-sm-0 flex-grow-1 container">
    <div class="d-md-flex gap-5 align-items-center">
        <img src="{{asset('img/register.png')}}" alt="Ilustrasi Register" class="img-fluid p-3 d-none d-sm-block" width="360" height="360">
        <form class="w-100" action="{{ route('register.store') }}"  method="POST">
            @csrf
            <div class="mb-5">
                <h2 class="fw-semibold text-primary">DAFTAR</h2>
            </div>
            <h6 class="mb-4 text-muted">Isi semua data di bawah ini dengan benar!</h6>
            <div class="mb-3">
                <label for="nama-lengkap" class="form-label fw-semibold" value="{{ old('namaInput') }}">Nama Lengkap</label>
                <input type="text" name="namaInput" placeholder="Nama Lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_hpInput" class="form-label fw-semibold" value="{{ old('no_hpInput') }}">Nomor HP</label>
                <input type="text" name="no_hpInput" placeholder="Nomor HP" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label fw-semibold" value="{{ old('emailInput') }}">Email</label>
                <input type="text" name="emailInput" placeholder="Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alamatInput" class="form-label fw-semibold" value="{{ old('alamatInput') }}">Alamat</label>
                <input type="text" name="alamatInput" placeholder="Alamat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenisKelamin" id="lakiLaki"
                        value="L">
                    <label class="form-check-label" for="lakiLaki">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan"
                        value="P">
                    <label class="form-check-label" for="perempuan">
                        Perempuan
                    </label>
                </div>
                @error('jenisKelamin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <input type="password" name="passwordInput" placeholder="Password" class="form-control" id="password-input" required>
                    <button type="button" class="btn btn-outline-primary" id="toggle-password">
                        <i class="bi bi-eye-slash" id="toggle-icon"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="peranInput" class="form-label fw-semibold">Peran</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="peranInput" id="flexRadioDefault1"
                        value="guru" onchange="toggleKelasDropdown()">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Guru
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="peranInput" id="flexRadioDefault2"
                        value="siswa" onchange="toggleKelasDropdown()">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Siswa
                    </label>
                </div>
                @error('peranInput')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3" id="kelasInputContainer" style="display: none">
                <label for="kelasInput" class="form-label fw-semibold" >Kelas</label>
                <select class="form-select" aria-label="Default select example" name="kelasInput">
                    <option selected>Pilih Kelas</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="token" class="form-label text-gray">
                    Token Kelas 
                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" title="Hubungi dosen untuk meminta token kelas."></i>
                </label>
                <input type="text" name="token" placeholder="Token Kelas" class="form-control" required disabled>
            </div>
            <div class="mt-4">
                <button type="submit" class="me-2 btn btn-primary">DAFTAR</button>
                <button type="reset" class="btn btn-outline-dark">RESET</button>
            </div>
            <div class="mt-5">
                <small class="small form-text">
                    Sudah punya akun? <a href="/masuk">Masuk</a>
                </small>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleKelasDropdown() {
        var siswaRadio = document.getElementById('flexRadioDefault2');
        var kelasInputContainer = document.getElementById('kelasInputContainer');
        
        if (siswaRadio.checked) {
            kelasInputContainer.style.display = 'block';
        } else {
            kelasInputContainer.style.display = 'none';
        }
    }
</script>

<script src="{{asset('js/showPass.js')}}"></script>

@endsection