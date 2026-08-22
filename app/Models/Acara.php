<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acara';

    protected $fillable = ['nama_acara', 'deskripsi', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'gambar', 'status',
        'latitude',
        'longitude'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getStatusAttribute($value)
    {
        $today = Carbon::today();
        $mulai = $this->tanggal_mulai ? $this->tanggal_mulai->copy()->startOfDay() : null;
        $selesai = ($this->tanggal_selesai ?? $this->tanggal_mulai)?->copy()->startOfDay();

        if ($mulai && $today->lt($mulai)) {
            return 'upcoming';
        }

        if ($selesai && $today->gt($selesai)) {
            return 'completed';
        }

        return 'ongoing';
    }
}
