@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-white">Dashboard Overview</h2>
        <p class="text-secondary">Selamat datang kembali, Admin Cineposter.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="bi bi-film text-danger fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary mb-1">Total Movie Terposting</h6>
                        <h3 class="fw-bold mb-0 text-white">{{ $totalMovies ?? 0 }}</h3>
                        <a href="{{ route('admin.movies') }}" class="text-danger small text-decoration-none">Lihat Detail →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-chat-left-text text-warning fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary mb-1">Ulasan Pengguna</h6>
                        <h3 class="fw-bold mb-0 text-white">{{ $totalReviews ?? 0 }}</h3>
                        <a href="{{ route('admin.reviews') }}" class="text-warning small text-decoration-none">Kelola Review →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-people text-info fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary mb-1">User Terdaftar</h6>
                        <h3 class="fw-bold mb-0 text-white">{{ $totalUsers ?? 0 }}</h3>
                        <span class="text-secondary small">Role: Login User</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header bg-transparent border-secondary py-3">
                    <h5 class="mb-0 text-white fw-bold">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body text-center py-5">
                    <i class="bi bi-graph-up text-secondary fs-1 mb-3"></i>
                    <p class="text-secondary">Data statistik mingguan akan muncul di sini setelah sistem berjalan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection