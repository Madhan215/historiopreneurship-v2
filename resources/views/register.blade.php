<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url("https://duniamasjid.islamic-center.or.id/wp-content/uploads/2014/05/masjid-sultan-suriansyah.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .form-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-label {
            font-weight: bold;
        }

        .text-center {
            margin-bottom: 30px;
        }

        #kelasInputContainer {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container p-3">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="form-card p-4">
                    <h1 class="text-center">Registrasi Pengguna Baru</h1>
                    <form method="post" action="{{ route('register.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="namaInput" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-lg @error('namaInput') is-invalid @enderror"
                                id="namaInput" name="namaInput" value="{{ old('namaInput') }}">
                            @error('namaInput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hpInput" class="form-label">No HP</label>
                            <input type="text" class="form-control form-control-lg @error('no_hpInput') is-invalid @enderror"
                                id="no_hpInput" name="no_hpInput" value="{{ old('no_hpInput') }}">
                            @error('no_hpInput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="text" class="form-control form-control-lg @error('emailInput') is-invalid @enderror"
                                id="emailInput" name="emailInput" value="{{ old('emailInput') }}">
                            @error('emailInput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamatInput" class="form-label">Alamat</label>
                            <input type="text" class="form-control form-control-lg @error('alamatInput') is-invalid @enderror"
                                id="alamatInput" name="alamatInput" value="{{ old('alamatInput') }}">
                            @error('alamatInput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <label for="passwordInput" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg @error('passwordInput') is-invalid @enderror"
                                id="passwordInput" name="passwordInput">
                            @error('passwordInput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="passwordInput_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                class="form-control form-control-lg @error('passwordInput_confirmation') is-invalid @enderror"
                                id="passwordInput_confirmation" name="passwordInput_confirmation">
                            @error('passwordInput_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="peranInput" class="form-label">Peran</label>
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

                        <div class="mb-3" id="kelasInputContainer">
                            <label for="kelasInput" class="form-label">Kelas</label>
                            <select class="form-select form-select-lg" aria-label="Default select example" name="kelasInput">
                                <option selected>Pilih Kelas</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
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

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
