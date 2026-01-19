@extends('layouts.app')

@section('content')
<style>
    /* Mengikuti tema Dark Cinema dari Landing Page */
    body {
        background-color: #0f0f0f !important;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    .register-card {
        background-color: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .register-header {
        background-color: transparent;
        border-bottom: 1px solid #333;
        color: #e50914; /* Merah Brand */
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    /* Styling Input Form agar menyatu dengan background gelap */
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

    /* Tombol Daftar */
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

    label {
        color: #ccc;
        font-weight: 500;
    }

    .login-link {
        color: #777;
        font-size: 0.9rem;
    }

    .login-link a {
        color: #e50914;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card register-card shadow border-0">
                <div class="register-header">{{ __('BUAT AKUN CINEPOSTER') }}</div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_depan" class="form-label">{{ __('Nama Depan') }}</label>
                            <input id="nama_depan" type="text" class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan" value="{{ old('nama_depan') }}" required autocomplete="nama_depan" autofocus placeholder="Contoh: John">
                            
                            @error('nama_depan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@contoh.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Daftar Sekarang') }}
                            </button>
                        </div>

                        <div class="text-center login-link">
                            <p>Sudah punya akun? <a href="{{ route('login') }}">{{ __('Masuk di sini') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection