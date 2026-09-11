<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = ['judul', 'ringkasan', 'isi', 'gambar', 'galeri', 'penulis', 'featured', 'created_by'];

    protected $casts = [
        'galeri' => 'array',
    ];

    public function subBerita()
    {
        return $this->hasMany(SubBerita::class)->orderBy('urutan', 'asc');
    }

    public function renderIsi(): string
    {
        $isi = nl2br(e($this->isi));
        $galeri = $this->galeri ?? [];

        return preg_replace_callback('/\[foto(\d+)\]/', function ($m) use ($galeri) {
            $idx = (int) $m[1] - 1;
            if (isset($galeri[$idx])) {
                return '<figure class="my-6"><img src="' . asset('storage/' . $galeri[$idx]) . '" alt="Foto" class="w-full h-auto rounded-xl border border-gold-500/10"></figure>';
            }
            return $m[0];
        }, $isi);
    }
}
