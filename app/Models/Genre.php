<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    protected $fillable = ['nama_genre'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre', 'id_genre', 'id_film');
    }
}
