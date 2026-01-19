<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan daftar semua ulasan.
     */
    public function index()
    {
        // Mengambil ulasan beserta data user dan movie (Eager Loading)
        $reviews = Review::with(['user', 'movie'])->latest()->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Menghapus ulasan yang tidak pantas.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
