<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['badge', 'judul_atas', 'judul_tengah', 'judul_bawah', 'deskripsi', 'gambar', 'btn1_teks', 'btn1_link', 'btn2_teks', 'btn2_link'];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
