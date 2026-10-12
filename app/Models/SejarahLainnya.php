<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahLainnya extends Model
{
    use HasFactory;

    protected $table = 'sejarah_lainnya';

    protected $fillable = ['judul', 'ringkasan', 'isi', 'gambar', 'urutan'];
}
