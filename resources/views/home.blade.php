@extends('layouts.app')

@section('content')
<style>
    /* Global Styles */
    body { 
        background-color: #0d0d0d !important; 
    }

    /* Memperbaiki Navigasi Agar Terang */
    .navbar-brand, .nav-link {
        color: #ffffff !important;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-banner {
        background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        padding: 80px 20px;
        margin-bottom: 50px;
        border: 1px solid #222;
    }

    .movie-poster-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 2/3;
        box-shadow: 0 10px 20px rgba(0,0,0,0.6);
        border: 1px solid #333;
    }

    .movie-poster-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Judul Film di Atas Poster - Dibuat Kontras (Kuning Emas) */
    .movie-title-home {
        color: #ffc107 !important; /* Kuning Emas */
        font-weight: 800;
        font-size: 1.1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,1); /* Shadow tebal agar tulisan "keluar" */
        margin-bottom: 2px;
        display: block;
    }

    .overlay-description {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(229, 9, 20, 0.9); /* Merah Netflix */
        color: white;
        padding: 20px;
        transform: translateY(101%);
        transition: transform 0.4s ease-in-out;
        font-size: 0.85rem;
        max-height: 100%;
    }

    .movie-card:hover .overlay-description {
        transform: translateY(0);
    }

    .movie-card:hover img {
        transform: scale(1.15);
    }

    .rating-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0,0,0,0.8);
        backdrop-filter: blur(8px);
        color: #ffc107;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 900;
        font-size: 0.85rem;
        z-index: 2;
        border: 1px solid rgba(255,193,7,0.3);
    }

    .movie-card {
        transition: all 0.3s ease;
    }

    .movie-card:hover {
        transform: translateY(-10px);
    }

    /* Info Sutradara & Tahun agar tidak gelap */
    .text-light-custom {
        color: #cccccc !important;
        font-size: 0.85rem;
    }

    /* Tombol Kembali/Detail agar Putih Terang */
    .btn-nonton-home {
        background: #e50914;
        border: none;
        color: white !important;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-nonton-home:hover {
        background: #ff121e;
        box-shadow: 0 0 15px rgba(229, 9, 20, 0.5);
    }
</style>

<div class="container py-4">
    <div class="hero-banner text-center text-white shadow-lg">
        <h1 class="fw-bold display-3 text-danger mb-3" style="letter-spacing: 5px;">CINEPOSTER</h1>
        <p class="lead text-white opacity-75">
            Selamat Datang, <span class="text-danger fw-bold">{{ Auth::user()->name }}</span>.
            Temukan trailer terbaru dan berikan ulasan jujurmu.
        </p>
    </div>

    <div class="d-flex align-items-center mb-5">
        <div class="bg-danger" style="width: 6px; height: 35px; border-radius: 10px;"></div>
        <h2 class="text-white fw-bold ms-3 mb-0">RILISAN TERBARU</h2>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
        @forelse($movies as $movie)
            <div class="col">
                <div class="card bg-transparent border-0 movie-card h-100">
                    <div class="movie-poster-container">
                        <div class="rating-badge shadow-sm">
                            <i class="bi bi-star-fill me-1"></i> {{ number_format($movie->rating_rata_rata, 1) }}
                        </div>
                        
                        <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->judul }}" onerror="this.src='https://via.placeholder.com/300x450?text=Poster+Not+Found'">
                        
                        <div class="overlay-description d-flex flex-column justify-content-center">
                            <p class="mb-2 fw-bold border-bottom pb-1" style="font-size: 1rem;">SINOPSIS</p>
                            <p class="mb-0 lh-base">
                                {{ $movie->sinopsis ?? 'Belum ada sinopsis untuk film ini.' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-3 text-start">
                        <span class="movie-title-home text-uppercase text-truncate" title="{{ $movie->judul }}">
                            {{ $movie->judul }}
                        </span>
                        
                        <p class="text-light-custom mb-3">
                            {{ $movie->tahun_rilis }} • <span class="text-danger small fw-bold">{{ $movie->sutradara }}</span>
                        </p>
                        
                        <a href="{{ route('movie.show', $movie->id_film) }}" class="btn btn-nonton-home w-100 rounded-pill py-2 shadow-sm">
                            <i class="bi bi-play-circle-fill me-2"></i> LIHAT DETAIL
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-secondary py-5 mt-5">
                <i class="bi bi-camera-reels display-1 mb-3 opacity-25"></i>
                <p class="fs-5">Belum ada film yang ditambahkan ke koleksi.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    // Memastikan background body selalu hitam
    document.body.style.backgroundColor = "#0d0d0d";
</script>
@endsection