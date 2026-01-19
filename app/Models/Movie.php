<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_film';

    protected $fillable = [
        'judul',
        'tahun_rilis',
        'sinopsis',
        'sutradara',
        'durasi_menit',
        'poster_url',
        'trailer_url',
        'link_nonton', // Tambahan
        'platform',    // Tambahan
        'lokasi_bioskop',
        'rating_rata_rata',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_film', 'id_film');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'id_film', 'id_genre');
    }
}
