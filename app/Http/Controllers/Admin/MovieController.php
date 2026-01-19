<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Menambahkan link_nonton & deskripsi agar diakui Laravel)
        $request->validate([
            'judul' => 'required|string|max:255',
            'sutradara' => 'required|string|max:255',
            'tahun_rilis' => 'required|integer',
            'durasi_menit' => 'required|integer',
            'deskripsi' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'trailer_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:51200',
            'link_nonton' => 'nullable|string', // Validasi format URL
            'platform' => 'nullable|string|max:50',
        ]);

        // 2. Handle Upload Poster
        $pathPoster = null;
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $namaFile = time() . '_' . str_replace(' ', '_', strtolower($request->judul)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('posters'), $namaFile);
            $pathPoster = 'posters/' . $namaFile;
        }

        // 3. Handle Upload Video Trailer
        $pathTrailer = null;
        if ($request->hasFile('trailer_file')) {
            $video = $request->file('trailer_file');
            $namaVideo = time() . '_' . str_replace(' ', '_', strtolower($request->judul)) . '.' . $video->getClientOriginalExtension();
            $pathTrailer = $video->storeAs('trailers', $namaVideo, 'public');
        }

        // 4. Simpan Data
        Movie::create([
            'judul' => $request->judul,
            'sutradara' => $request->sutradara,
            'tahun_rilis' => $request->tahun_rilis,
            'durasi_menit' => $request->durasi_menit,
            'poster_url' => $pathPoster,
            'sinopsis' => $request->deskripsi, 
            'trailer_url' => $pathTrailer,
            'link_nonton' => $request->link_nonton,
            'platform' => $request->platform ?? 'LK21',
            'lokasi_bioskop' => $request->lokasi_bioskop ?? '',
            'rating_rata_rata' => 0.0,
        ]);

        return redirect()->route('admin.movies')->with('success', 'Film baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

   public function update(Request $request, $id)
{
    $movie = Movie::findOrFail($id);

    // Validasi yang lebih longgar dulu untuk testing
    $request->validate([
        'judul' => 'required',
        'sutradara' => 'required',
        'tahun_rilis' => 'required|integer',
        'durasi_menit' => 'required|integer',
    ]);

    // Handle Upload Poster
    $pathPoster = $movie->poster_url;
    if ($request->hasFile('poster')) {
        if ($movie->poster_url && File::exists(public_path($movie->poster_url))) {
            File::delete(public_path($movie->poster_url));
        }
        $file = $request->file('poster');
        $namaFile = time() . '_' . str_replace(' ', '_', strtolower($request->judul)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('posters'), $namaFile);
        $pathPoster = 'posters/' . $namaFile;
    }

    // Paksa update kolom demi kolom
    $movie->judul = $request->judul;
    $movie->sutradara = $request->sutradara;
    $movie->tahun_rilis = $request->tahun_rilis;
    $movie->durasi_menit = $request->durasi_menit;
    $movie->sinopsis = $request->deskripsi; // Sesuai name="deskripsi" di form
    $movie->poster_url = $pathPoster;
    $movie->link_nonton = $request->link_nonton; // Dipaksa masuk
    $movie->platform = $request->platform;
    
    // Simpan ke database
    $success = $movie->save();

    if ($success) {
        return redirect()->route('admin.movies')->with('success', 'Film berhasil diperbarui!');
    } else {
        return back()->with('error', 'Gagal menyimpan ke database.');
    }
}

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        // Hapus file fisik saat record dihapus
        if ($movie->poster_url && File::exists(public_path($movie->poster_url))) {
            File::delete(public_path($movie->poster_url));
        }
        if ($movie->trailer_url) {
            Storage::disk('public')->delete($movie->trailer_url);
        }

        $movie->delete();
        return redirect()->route('admin.movies')->with('success', 'Film berhasil dihapus.');
    }
}