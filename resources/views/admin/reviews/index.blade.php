@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-white">Kelola Ulasan</h2>
        <p class="text-secondary">Moderasi komentar dan rating dari pengguna Cineposter.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead class="table-secondary text-dark">
                        <tr>
                            <th class="ps-3">User</th>
                            <th>Film</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                        <tr class="align-middle">
                            <td class="ps-3">
                                <div class="fw-bold">{{ $review->user->name ?? 'User Terhapus' }}</div>
                                <small class="text-secondary">{{ $review->user->email ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="text-info">{{ $review->movie->judul ?? 'Film Terhapus' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill"></i> {{ $review->rating_numerik }}
                                </span>
                            </td>
                            <td style="max-width: 300px;" class="text-truncate">
                                {{ $review->teks_ulasan }}
                                @if($review->is_spoiler)
                                    <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">SPOILER</span>
                                @endif
                            </td>
                            <td>
                                {{ $review->tanggal_ulasan?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.reviews.destroy', $review->id_ulasan) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <i class="bi bi-chat-square-dots fs-1 d-block mb-3"></i>
                                Belum ada ulasan dari pengguna.
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