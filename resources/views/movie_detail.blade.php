@extends('layouts.app')

@section('content')

    <style>
        body {
            background-color: #0d0d0d;
            color: white;
        }

        /* Memperbaiki Navigasi agar Terlihat Terang */
        .navbar-brand,
        .nav-link,
        .btn-link-nav {
            color: #ffffff !important;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .nav-link:hover {
            color: #dc3545 !important;
        }

        /* Desain Detail */
        .bg-custom-dark {
            background-color: #141414;
            border: 1px solid #2a2a2a;
        }

        .bg-black-input {
            background-color: #000000 !important;
            border: 1px solid #444 !important;
            color: white !important;
        }

        /* Tombol Nonton LK21 */
        .btn-nonton {
            background: linear-gradient(45deg, #ff0000, #8b0000);
            border: none;
            color: white !important;
            padding: 15px;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .btn-nonton:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.4);
        }

        .review-card {
            background: #1a1a1a;
            border-left: 4px solid #dc3545;
        }

        .text-ulasan-user {
            color: #ffffff !important;
            font-size: 1rem;
            line-height: 1.6;
        }

        .section-label {
            color: #aaaaaa;
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>

    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-white text-decoration-none fw-bold shadow-sm">
                <i class="bi bi-arrow-left-circle-fill me-2 text-danger"></i> KEMBALI KE HOME
            </a>
        </div>

        <div class="row g-5">
            <div class="col-lg-4 text-center text-lg-start">
                <div class="position-relative mb-4 d-inline-block">
                    <img src="{{ asset($movie->poster_url) }}" class="img-fluid rounded-4 shadow-lg border border-secondary"
                        style="max-height: 500px;" alt="{{ $movie->judul }}">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-warning text-dark p-2 fs-6 shadow">
                            <i class="bi bi-star-fill"></i> {{ number_format($movie->rating_rata_rata, 1) }}
                        </span>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-2">
                    @if (!empty($movie->link_nonton))
                        <a href="{{ $movie->link_nonton }}" target="_blank"
                            class="btn btn-nonton rounded-3 fw-black shadow">
                            <i class="bi bi-play-circle-fill me-2"></i> NONTON SEKARANG
                        </a>
                    @else
                        <button class="btn btn-secondary btn-lg disabled rounded-3">LINK BELUM TERSEDIA</button>
                    @endif
                </div>
            </div>

            <div class="col-lg-8">
                <h1 class="display-3 fw-bold text-white mb-2">{{ $movie->judul }}</h1>
                <div class="mb-4 d-flex gap-3 align-items-center">
                    <span class="text-danger fw-bold fs-5">{{ $movie->tahun_rilis }}</span>
                    <span class="text-secondary">|</span>
                    <span class="text-white">{{ $movie->durasi_menit }} Menit</span>
                    <span class="badge bg-danger">18+</span>
                </div>

                <div class="mb-4">
                    <p class="section-label mb-1">Sutradara</p>
                    <p class="text-white fs-5">{{ $movie->sutradara }}</p>

                    <p class="section-label mb-1 mt-3">Sinopsis</p>
                    <p class="text-white-50 fs-5 lh-lg">{{ $movie->sinopsis }}</p>
                </div>

                <div class="mb-5">
                    <p class="section-label mb-3 text-white">Trailer Resmi</p>
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden border border-dark">
                        @if ($movie->trailer_url)
                            <video controls poster="{{ asset($movie->poster_url) }}">
                                <source src="{{ asset('storage/' . $movie->trailer_url) }}" type="video/mp4">
                                <source src="{{ asset($movie->trailer_url) }}" type="video/mp4">
                            </video>
                        @else
                            <div class="bg-dark d-flex align-items-center justify-content-center text-secondary">
                                Trailer tidak tersedia
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-5 border-top border-secondary pt-5">
                    <h3 class="text-white fw-bold mb-4">Bagaimana menurutmu?</h3>

                    @auth
                        <div class="bg-custom-dark p-4 rounded-4 shadow-sm mb-5">
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_film" value="{{ $movie->id_film }}">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="text-white small mb-2">Skor (1-10)</label>
                                        <input type="number" name="rating_numerik"
                                            class="form-control bg-black-input border-0 py-2" min="1" max="10"
                                            required placeholder="Contoh: 9">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-white small mb-2">Tuliskan Komentar</label>
                                        <textarea name="teks_ulasan" class="form-control bg-black-input border-0" rows="3" required
                                            placeholder="Ceritakan pendapatmu..."></textarea>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit"
                                            class="btn btn-danger px-5 py-2 fw-bold rounded-pill shadow">KIRIM ULASAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="alert bg-custom-dark border-danger text-center p-4">
                            <p class="text-white mb-3">Anda harus Login untuk memberikan rating.</p>
                            <a href="{{ route('login') }}" class="btn btn-danger px-4 rounded-pill fw-bold">LOGIN SEKARANG</a>
                        </div>
                    @endauth

                    <div class="mt-4">
                        <p class="section-label mb-4">Ulasan Penonton</p>
                        @forelse($reviews as $review)
                            <div class="review-card p-4 rounded-3 mb-3 shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-danger fw-bold"><i class="bi bi-person-fill"></i>
                                        {{ $review->user->name }}</span>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i>
                                        {{ $review->rating_numerik }}/10</span>
                                </div>
                                <p class="text-ulasan-user mb-0">"{{ $review->teks_ulasan }}"</p>
                                <small class="text-secondary">{{ $review->tanggal_ulasan?->diffForHumans() }}</small>
                            </div>
                        @empty
                            <p class="text-secondary">Belum ada ulasan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
