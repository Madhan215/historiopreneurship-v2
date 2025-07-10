@extends('layouts.home')

@section('container')



<div class="p-5 p-sm-5 mb-5 mb-sm-0 flex-grow-1 container">
    <div class="d-md-flex gap-5 align-items-center">
        <img src="{{asset('img/login.png')}}" alt="Ilustrasi Login" class="img-fluid p-3 d-none d-sm-block" width="360" height="360">
        <form class="w-100" method="POST" action="{{ route('login.auth') }}">
            @csrf
            <div class="mb-5">
                <h2 class="fw-semibold text-primary">MASUK</h2>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" id="password-input">
                    <button type="button" class="btn btn-outline-primary" id="toggle-password">
                        <i class="bi bi-eye-slash" id="toggle-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="text-end mt-2">
                    <small class="small form-text">
                        <span class="text-primary text-decoration-underline" data-bs-toggle='tooltip' title="Silahkan hubungi dosen pengajar untuk me-reset password!">
                            Lupa Password?
                        </span>
                    </small>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="me-2 btn btn-primary">MASUK</button>
                <button type="reset" class="btn btn-outline-dark">RESET</button>
            </div>
            <div class="mt-5">
                <small class="small form-text">
                    Belum punya akun? <a href="/daftar">Daftar</a>
                </small>
            </div>
        </form>
    </div>
</div>

<script src="{{asset('js/showPass.js')}}"></script>

@endsection