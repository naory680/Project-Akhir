@extends('layouts.app')

@section('content')
<style>
    /* Mengubah background body khusus halaman login agar match dengan landing page */
    body {
        background-color: #0f0f0f !important;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    /* Styling Card Login */
    .login-card {
        background-color: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .login-header {
        background-color: transparent;
        border-bottom: 1px solid #333;
        color: #e50914; /* Merah Brand */
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    /* Styling Input Form */
    .form-control {
        background-color: #2b2b2b !important;
        border: 1px solid #444 !important;
        color: white !important;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #e50914 !important;
        box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25) !important;
    }

    /* Tombol Login */
    .btn-primary {
        background-color: #e50914 !important;
        border: none !important;
        padding: 10px;
        font-weight: bold;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #b20710 !important;
        transform: translateY(-2px);
    }

    .btn-link {
        color: #777 !important;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-link:hover {
        color: #e50914 !important;
    }

    label {
        color: #ccc;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card">
                <div class="login-header">{{ __('CINEPOSTER LOGIN') }}</div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Masuk Sekarang') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                            <hr class="border-secondary">
                            <p class="text-secondary small">Belum punya akun? <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Daftar di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection