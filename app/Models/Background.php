<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'gambar', 'pola', 'aktif'];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}