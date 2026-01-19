<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data real-time dari database
        $totalMovies = Movie::count();
        $totalReviews = Review::count();

        // Menghitung user biasa (yang bukan admin)
        // Sesuaikan kolom 'role' dengan nama kolom di tabel users kamu
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Mengirim data ke view dashboard.blade.php
        return view('admin.dashboard', compact('totalMovies', 'totalReviews', 'totalUsers'));
    }
}
