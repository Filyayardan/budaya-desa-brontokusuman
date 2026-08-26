<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budaya;
use App\Models\KategoriBudaya;
use App\Models\Acara;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Sejarah;
use App\Models\Pengurus;
use App\Models\Visitor;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'kategori' => KategoriBudaya::count(),
            'budaya' => Budaya::count(),
            'acara' => Acara::count(),
            'berita' => Berita::count(),
            'galeri' => Galeri::count(),
            'sejarah' => Sejarah::count(),
            'pengurus' => Pengurus::count(),
            'visitor' => Visitor::count(),
        ];

        $recentBudaya = Budaya::with('kategori')->latest()->limit(5)->get();
        $recentBerita = Berita::latest()->limit(5)->get();
        $recentAcara = Acara::orderBy('tanggal_mulai', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBudaya', 'recentBerita', 'recentAcara'));
    }
}
