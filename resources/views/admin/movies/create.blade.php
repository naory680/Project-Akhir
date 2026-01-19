@extends('admin.layout')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.movies') }}" class="text-secondary text-decoration-none small">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Movie
        </a>
        <h2 class="fw-bold text-white mt-2">Tambah Film Baru</h2>
    </div>

    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card bg-dark border-secondary shadow mb-4">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="text-secondary mb-2">Judul Film</label>
                                <input type="text" name="judul" class="form-control bg-black border-secondary text-white @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="text-secondary mb-2">Sutradara</label>
                                <input type="text" name="sutradara" class="form-control bg-black border-secondary text-white" value="{{ old('sutradara') }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="text-secondary mb-2">Tahun Rilis</label>
                                <input type="number" name="tahun_rilis" class="form-control bg-black border-secondary text-white" value="{{ old('tahun_rilis', date('Y')) }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="text-secondary mb-2">Durasi (Menit)</label>
                                <input type="number" name="durasi_menit" class="form-control bg-black border-secondary text-white" value="{{ old('durasi_menit') }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="text-secondary mb-2">Upload Poster Film</label>
                                <input type="file" name="poster" class="form-control bg-black border-secondary text-white @error('poster') is-invalid @enderror" accept="image/*" required>
                                @error('poster') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="text-secondary mb-2">Upload File Trailer (Video)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary border-secondary text-white"><i class="bi bi-camera-video"></i></span>
                                    <input type="file" name="trailer_file" class="form-control bg-black border-secondary text-white @error('trailer_file') is-invalid @enderror" accept="video/mp4,video/x-m4v,video/*">
                                </div>
                                <small class="text-muted">Format: MP4, Max: 50MB</small>
                                @error('trailer_file') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="text-secondary mb-2">Sinopsis</label>
                                <textarea name="deskripsi" rows="5" class="form-control bg-black border-secondary text-white" placeholder="Tuliskan cerita singkat film di sini...">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark border-secondary shadow mb-4">
                    <div class="card-body">
                        <h5 class="text-white fw-bold mb-3">Link & Ketersediaan</h5>
                        
                        <div class="mb-3">
                            <label class="text-secondary mb-2">Link Nonton (LK21/Streaming)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-white"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="link_nonton" class="form-control bg-black border-secondary text-white" placeholder="https://..." value="{{ old('link_nonton') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="text-secondary mb-2">Nama Platform</label>
                            <input type="text" name="platform" class="form-control bg-black border-secondary text-white" placeholder="LK21, Netflix, dll" value="{{ old('platform', 'LK21') }}">
                        </div>

                        <hr class="text-secondary">
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger py-2 fw-bold shadow-sm">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i> SIMPAN FILM
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .form-control:focus { background-color: #000 !important; border-color: #e50914 !important; box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25); color: white; }
    .input-group-text { border-color: #333; }
</style>
@endsection