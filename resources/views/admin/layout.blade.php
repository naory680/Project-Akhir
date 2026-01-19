<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cineposter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #121212;
            color: white;
            overflow-x: hidden;
        }

        /* PERBAIKAN SIDEBAR */
        .sidebar {
            width: 280px;
            height: 100vh; /* Kunci tinggi sesuai layar */
            position: fixed; /* Kunci posisi agar tidak bergeser */
            top: 0;
            left: 0;
            background-color: #1a1a1a;
            border-right: 1px solid #333;
            z-index: 1000;
        }

        /* MEMBERI RUANG AGAR KONTEN TIDAK TERTUTUP SIDEBAR */
        .main-content {
            margin-left: 280px; /* Harus sama dengan lebar sidebar */
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        .nav-link {
            color: #ccc;
            transition: 0.3s;
            border-radius: 8px; /* Membuat sudut link lebih halus */
            margin: 2px 0;
        }

        .nav-link:hover {
            color: white !important;
            background-color: rgba(229, 9, 20, 0.1) !important;
        }

        .nav-link.active {
            color: white !important;
            background-color: #e50914 !important;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-2">
            <span class="fs-4 fw-bold text-danger">CINEPOSTER</span>
        </a>
        <hr class="text-secondary">
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.movies') }}" class="nav-link {{ request()->routeIs('admin.movies*') ? 'active' : '' }}">
                    <i class="bi bi-film me-2"></i> Kelola Movie
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text me-2"></i> Kelola Review
                </a>
            </li>
        </ul>
        
        <hr class="text-secondary">
        <div class="px-2">
            <a href="{{ route('logout') }}" class="nav-link text-danger fw-bold" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="main-content p-4">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>