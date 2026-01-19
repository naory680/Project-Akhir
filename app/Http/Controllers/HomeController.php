<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (Home)
     */
    public function index()
    {
        // Mengambil semua film untuk ditampilkan di home
        $movies = Movie::latest()->get();
        return view('home', compact('movies'));
    }

    /**
     * Menampilkan detail film dan ulasannya
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        // Ambil ulasan beserta data user yang membuatnya
        $reviews = Review::where('id_film', $id)
            ->with('user')
            ->orderBy('tanggal_ulasan', 'desc')
            ->get();

        return view('movie_detail', compact('movie', 'reviews'));
    }

    /**
     * Menyimpan ulasan baru
     */
    public function storeReview(Request $request)
    {
        $request->validate([
            'id_film' => 'required|exists:movies,id_film',
            'rating_numerik' => 'required|integer|min:1|max:10',
            'teks_ulasan' => 'required|string|min:5',
        ]);

        Review::create([
            'id_pengguna' => Auth::id(),
            'id_film' => $request->id_film,
            'rating_numerik' => $request->rating_numerik,
            'teks_ulasan' => $request->teks_ulasan,
            'is_spoiler' => $request->has('is_spoiler') ? 1 : 0,
        ]);

        $this->updateMovieRating($request->id_film);

        return redirect()->route('movie.show', $request->id_film)->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Update ulasan yang sudah ada
     */
    public function updateReview(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Pastikan hanya pemilik yang bisa edit dan dalam batas 1 jam
        if ($review->id_pengguna !== Auth::id() || $review->tanggal_ulasan->diffInMinutes(now()) >= 60) {
            return back()->with('error', 'Akses ditolak atau batas waktu edit habis.');
        }

        $request->validate([
            'rating_numerik' => 'required|integer|min:1|max:10',
            'teks_ulasan' => 'required|string|min:5',
        ]);

        $review->update([
            'rating_numerik' => $request->rating_numerik,
            'teks_ulasan' => $request->teks_ulasan,
        ]);

        $this->updateMovieRating($review->id_film);

        return back()->with('success', 'Ulasan berhasil diperbarui!');
    }

    /**
     * Fungsi pembantu untuk hitung ulang rating rata-rata film
     */
    private function updateMovieRating($id_film)
    {
        $averageRating = Review::where('id_film', $id_film)->avg('rating_numerik');
        Movie::where('id_film', $id_film)->update(['rating_rata_rata' => $averageRating]);
    }

    public function myReviews()
    {
        $reviews = Review::where('id_pengguna', Auth::id())
            ->with('movie') // Eager loading agar judul film muncul
            ->orderBy('tanggal_ulasan', 'desc')
            ->get();

        return view('my_reviews', compact('reviews'));
    }
}
