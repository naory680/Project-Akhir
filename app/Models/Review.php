<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
        'id_pengguna',
        'id_film',
        'rating_numerik',
        'teks_ulasan',
        'is_spoiler'
    ];

    const CREATED_AT = 'tanggal_ulasan';
    const UPDATED_AT = 'updated_at';

    protected $casts = [
        'tanggal_ulasan' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_film', 'id_film');
    }

    /**
     * Cek apakah ulasan masih dalam batas waktu 1 jam untuk diedit
     */
    public function isEditable()
    {
        // Menggunakan pencocokan waktu saat ini (now())
        return $this->tanggal_ulasan && $this->tanggal_ulasan->diffInMinutes(now()) < 60;
    }
}
