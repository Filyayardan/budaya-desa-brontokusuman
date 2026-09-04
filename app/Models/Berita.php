<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = ['judul', 'ringkasan', 'isi', 'gambar', 'penulis', 'featured'];

    public function subBerita()
    {
        return $this->hasMany(SubBerita::class)->orderBy('urutan', 'asc');
    }
}
