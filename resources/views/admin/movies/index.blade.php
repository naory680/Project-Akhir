@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-white mb-0">Kelola Movie</h2>
            <p class="text-secondary small">Total film terdaftar: {{ $movies->count() }}</p>
        </div>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-danger shadow px-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah Film Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="table-black">
                        <tr class="text-secondary border-secondary">
                            <th class="ps-4">Poster</th>
                            <th>Judul</th>
                            <th>Sutradara</th>
                            <th>Rating</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $movie)
                        <tr class="border-secondary">
                            <td class="ps-4">
                                <img src="{{ asset($movie->poster_url) }}" 
                                     alt="Poster {{ $movie->judul }}" 
                                     width="60" 
                                     height="85" 
                                     class="rounded shadow-sm border border-secondary" 
                                     style="object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $movie->judul }}</div>
                                <div class="text-secondary small">{{ $movie->tahun_rilis }}</div>
                            </td>
                            <td>{{ $movie->sutradara }}</td>
                            <td class="text-warning">
                                <i class="bi bi-star-fill me-1"></i> 
                                {{ number_format($movie->rating_rata_rata, 1) }}
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.movies.edit', $movie->id_film) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.movies.destroy', $movie->id_film) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-5">
                                <i class="bi bi-film d-block mb-3" style="font-size: 3rem;"></i>
                                Belum ada data film yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection