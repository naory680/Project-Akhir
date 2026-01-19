<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineposter - Review & Trailer Film Dunia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0f0f0f; color: #ffffff; }
        .navbar { background-color: rgba(0,0,0,0.9); border-bottom: 1px solid #333; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        .card-movie {
            background-color: #1a1a1a;
            border: none;
            transition: transform 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }
        .card-movie:hover { transform: scale(1.05); }
        .card-movie img { border-radius: 15px 15px 0 0; height: 400px; object-fit: cover; }
        .btn-primary { background-color: #e50914; border: none; } /* Warna ala Netflix */
        .btn-primary:hover { background-color: #b20710; }
        .footer { padding: 50px 0; border-top: 1px solid #333; margin-top: 50px; color: #777; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="/">CINEPOSTER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Jelajahi Dunia Perfilman</h1>
            <p class="lead mb-4">Baca review jujur, tonton trailer terbaru, dan temukan bioskop terdekat.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 shadow">Mulai Sekarang</a>
            @endguest
        </div>
    </header>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Film Saat Ini</h2>
            <hr class="flex-grow-1 ms-4 border-secondary d-none d-md-block">
        </div>

        <div class="row g-4">
            @foreach($movies as $movie)
            <div class="col-md-4 col-lg-3">
                <div class="card card-movie shadow">
                    <img src="{{ $movie->poster_url }}" class="card-img-top" alt="{{ $movie->judul }}">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $movie->judul }}</h5>
                        <p class="text-warning mb-2 small">⭐ {{ number_format($movie->rating_rata_rata, 1) }} / 5.0</p>
                        <p class="card-text text-secondary small text-truncate">{{ $movie->sinopsis }}</p>
                        <a href="/movie/{{ $movie->id_film }}" class="btn btn-outline-light btn-sm w-100">Detail & Trailer</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2026 Cineposter. All Rights Reserved.</p>
            <div class="small">Dibuat dengan ❤️ untuk pecinta film.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>