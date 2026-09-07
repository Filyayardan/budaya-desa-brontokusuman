<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBerita extends Model
{
    use HasFactory;

    protected $table = 'sub_berita';

    protected $fillable = ['berita_id', 'judul_sub', 'isi_sub', 'gambar', 'galeri', 'urutan'];

    protected $casts = [
        'galeri' => 'array',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    public function renderIsi(): string
    {
        $isi = nl2br(e($this->isi_sub));
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
