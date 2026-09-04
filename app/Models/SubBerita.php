<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBerita extends Model
{
    use HasFactory;

    protected $table = 'sub_berita';

    protected $fillable = ['berita_id', 'judul_sub', 'isi_sub', 'gambar', 'urutan'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
