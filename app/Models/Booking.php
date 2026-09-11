<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'budaya_id',
        'tanggal_acara',
        'nama_acara',
        'lokasi_acara',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
    ];

    public function budaya()
    {
        return $this->belongsTo(Budaya::class);
    }
}
