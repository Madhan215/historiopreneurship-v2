@extends('layouts.home')

@section('container')
    @if (session('success'))
        <div class="alert alert-success floating-alert fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-5 p-sm-5 mb-5 mb-sm-0 flex-grow-1 container">
        <div class="d-md-flex gap-5 align-items-center">
            <img src="{{ asset('img/Reset_password.png') }}" alt="Ilustrasi Login" class="img-fluid p-3 d-none d-sm-block"
                width="360" height="360">

            <form class="w-100" method="POST" action="{{ route('update.auth') }}">
                @csrf

                <div class="mb-5">
                    <h2 class="fw-semibold text-primary">RESET PASSWORD</h2>
                </div>

                <!-- Input Password Baru -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" id="password-input">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password-confirmation-input">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Checkbox Show Password -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="show-password">
                    <label class="form-check-label" for="show-password">Tampilkan Password</label>
                </div>

                <!-- Tombol Reset -->
                <div class="mt-4">
                    <button type="submit" class="me-2 btn btn-primary">RESET</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            let passwordInput = document.getElementById('password-input');
            let confirmPasswordInput = document.getElementById('password-confirmation-input');

            if (this.checked) {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
        });
    </script>
@endsection
