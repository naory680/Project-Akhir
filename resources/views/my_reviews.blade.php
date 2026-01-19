@extends('layouts.app')

@section('content')
<div class="container py-4 text-white">
    <h2 class="fw-bold mb-4 text-danger text-uppercase">Ulasan Saya</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($reviews as $review)
            <div class="col-md-6 mb-4">
                <div class="card bg-dark border-secondary h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="{{ asset($review->movie->poster_url) }}" class="rounded me-3" style="width: 60px; height: 80px; object-fit: cover;">
                            <div>
                                <h5 class="fw-bold mb-0 text-white">{{ $review->movie->judul }}</h5>
                                <small class="text-secondary">{{ $review->tanggal_ulasan->format('d M Y, H:i') }}</small>
                                <div class="text-warning small mt-1">
                                    <i class="bi bi-star-fill"></i> {{ $review->rating_numerik }}/10
                                </div>
                            </div>
                        </div>

                        <p class="text-light opacity-75 small italic">"{{ $review->teks_ulasan }}"</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            @if($review->tanggal_ulasan->diffInMinutes(now()) < 60)
                                <button class="btn btn-sm btn-outline-info rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editMyReview{{ $review->id_ulasan }}">
                                    <i class="bi bi-pencil-square"></i> Edit Ulasan
                                </button>
                            @else
                                <span class="badge bg-secondary opacity-50">Waktu edit habis</span>
                            @endif
                            <a href="{{ route('movie.show', $review->id_film) }}" class="btn btn-sm btn-link text-danger p-0">Lihat Film</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editMyReview{{ $review->id_ulasan }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white border-secondary">
                        <form action="{{ route('review.update', $review->id_ulasan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title text-danger">Edit Ulasan: {{ $review->movie->judul }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Rating (1-10)</label>
                                    <input type="number" name="rating_numerik" class="form-control bg-black text-white border-secondary" min="1" max="10" value="{{ $review->rating_numerik }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Komentar</label>
                                    <textarea name="teks_ulasan" class="form-control bg-black text-white border-secondary" rows="4" required>{{ $review->teks_ulasan }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="submit" class="btn btn-danger rounded-pill px-4">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-secondary">Kamu belum pernah memberikan ulasan.</p>
                <a href="{{ url('/') }}" class="btn btn-danger rounded-pill">Cari Film Sekarang</a>
            </div>
        @endforelse
    </div>
</div>

<style>
    .bg-black { background-color: #0b0b0b !important; }
    .hover-danger:hover { background-color: #dc3545 !important; color: white !important; }
</style>
@endsection