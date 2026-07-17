<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBudaya extends Model
{
    use HasFactory;

    protected $table = 'kategori_budaya';

    protected $fillable = ['nama_kategori', 'deskripsi', 'ikon'];

    public function budaya()
    {
        return $this->hasMany(Budaya::class, 'kategori_id');
    }
}
