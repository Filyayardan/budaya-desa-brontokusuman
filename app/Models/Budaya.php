<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    use HasFactory;

    protected $table = 'budaya';

    protected $fillable = ['kategori_id', 'judul', 'deskripsi', 'deskripsi_lengkap', 'gambar', 'video', 'lokasi', 'unggulan'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBudaya::class, 'kategori_id');
    }
}
