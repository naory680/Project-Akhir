<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. AKSES PUBLIK
Route::get('/', function () {
    $movies = Movie::all();
    return view('landing', compact('movies'));
})->name('landing');

Route::get('/movie/{id}', [HomeController::class, 'show'])->name('movie.show');


// 2. AUTHENTICATION (Login, Register, Logout)
Auth::routes();


// 3. AKSES USER TERAUTENTIKASI (Harus Login)
Route::middleware(['auth'])->group(function () {
    // Katalog utama
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Fitur Ulasan Saya
    Route::get('/my-reviews', [HomeController::class, 'myReviews'])->name('my.reviews');

    // CRUD Ulasan (Simpan & Update)
    Route::post('/review/store', [HomeController::class, 'storeReview'])->name('review.store');
    Route::put('/review/update/{id}', [HomeController::class, 'updateReview'])->name('review.update');
});


// 4. AKSES KHUSUS ADMIN
Route::middleware(['auth', 'can:admin-access'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Movies
    Route::controller(MovieController::class)->group(function () {
        Route::get('/movies', 'index')->name('admin.movies');
        Route::get('/movies/create', 'create')->name('admin.movies.create');
        Route::post('/movies/store', 'store')->name('admin.movies.store');
        Route::get('/movies/{id}/edit', 'edit')->name('admin.movies.edit');
        Route::put('/movies/{id}', 'update')->name('admin.movies.update');
        Route::delete('/movies/{id}', 'destroy')->name('admin.movies.destroy');
    });

    // Manajemen Reviews
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'index')->name('admin.reviews');
        Route::delete('/reviews/{id}', 'destroy')->name('admin.reviews.destroy');
    });
});
