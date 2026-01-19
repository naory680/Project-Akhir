<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data langsung dari database
        $totalMovies = Movie::count();
        $totalReviews = Review::count();

        // Menghitung user yang bukan admin (asumsi admin punya role 'admin')
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Mengirimkan variabel ke view dashboard
        return view('admin.dashboard', compact('totalMovies', 'totalReviews', 'totalUsers'));
    }
}
