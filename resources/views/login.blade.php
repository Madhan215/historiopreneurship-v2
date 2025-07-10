<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
        .img-background {
            background-image: url("https://duniamasjid.islamic-center.or.id/wp-content/uploads/2014/05/masjid-sultan-suriansyah.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            filter: grayscale(1);
        }

        .front-title {
            font-size: 50px;
            background-color: aliceblue;
            padding: 10px;
            border-radius: 10px;
        }

        .big-title {
            font-size: 70px;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container bg-primary vh-100">
        <div class="row">
            {{-- KOLOM 1 --}}
            <div class="col-md-8 bg-warning vh-100 img-background d-flex justify-content-center align-items-center ">

                <h1 class="front-title text-center">Media Pembelajaran <br>
                    <div class="big-title">Historiopreneurship</div>
                </h1>

            </div>
            {{-- KOLOM 2 --}}
            <div class="col-md-4 bg-dark vh-100 d-flex justify-content-center align-items-center">
                {{--TITLE --}}

                <div class="row justify-content-center">
                    <h1 class="text-center col-12 text-white">Login</h1>
                    {{-- FORM --}}
                    <div class="form text-white">
                        <form method="post" action="{{ route('login.auth') }}">
                            @csrf

                            <div class="mb-3 ">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="checkRemember" name="checkRemember">
                                <label class="form-check-label" for="checkRemember">Ingat Saya</label>
                            </div>

                            <div class="row text-end">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a href="{{ route('register.show') }}" class="btn btn-success">Register</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</body>

</html>