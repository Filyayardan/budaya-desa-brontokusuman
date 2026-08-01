<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use App\Models\KategoriBudaya;
use App\Models\Acara;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Sejarah;
use App\Models\Pengurus;
use App\Models\Banner;

class PageController extends Controller
{
    public function index()
    {
        $budayaUnggulan = Budaya::with('kategori')->where('unggulan', true)->limit(6)->get();
        $acaraTerbaru = Acara::orderBy('tanggal_mulai', 'desc')->limit(3)->get();
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')->limit(3)->get();
        $galeriTerbaru = Galeri::orderBy('created_at', 'desc')->limit(8)->get();
        $kategori = KategoriBudaya::withCount('budaya')->get();
        $banner = Banner::aktif()->first();

        return view('welcome', compact('budayaUnggulan', 'acaraTerbaru', 'beritaTerbaru', 'galeriTerbaru', 'kategori', 'banner'));
    }

    public function budaya()
    {
        $kategori = KategoriBudaya::all();
        $budaya = Budaya::with('kategori')->latest()->paginate(12);

        return view('pages.budaya', compact('budaya', 'kategori'));
    }

    public function budayaDetail($id)
    {
        $budaya = Budaya::with('kategori')->findOrFail($id);
        $terkait = Budaya::with('kategori')
            ->where('kategori_id', $budaya->kategori_id)
            ->where('id', '!=', $budaya->id)
            ->limit(3)
            ->get();

        return view('pages.budaya-detail', compact('budaya', 'terkait'));
    }

    public function budayaByKategori($id)
    {
        $kategoriAktif = KategoriBudaya::findOrFail($id);
        $budaya = Budaya::with('kategori')->where('kategori_id', $id)->latest()->paginate(12);
        $kategori = KategoriBudaya::all();

        return view('pages.budaya', compact('budaya', 'kategori', 'kategoriAktif'));
    }

    public function acara()
    {
        $acara = Acara::orderBy('tanggal_mulai', 'desc')->paginate(12);

        return view('pages.acara', compact('acara'));
    }

    public function acaraDetail($id)
    {
        $acara = Acara::findOrFail($id);

        return view('pages.acara-detail', compact('acara'));
    }

    public function galeri()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->paginate(16);
        $kategori = Galeri::distinct()->pluck('kategori')->filter();

        return view('pages.galeri', compact('galeri', 'kategori'));
    }

    public function berita()
    {
        $berita = Berita::orderBy('created_at', 'desc')->paginate(9);

        return view('pages.berita', compact('berita'));
    }

    public function beritaDetail($id)
    {
        $berita = Berita::findOrFail($id);
        $beritaLain = Berita::where('id', '!=', $id)->latest()->limit(3)->get();

        return view('pages.berita-detail', compact('berita', 'beritaLain'));
    }

    public function sejarah()
    {
        $sejarah = Sejarah::orderBy('urutan', 'asc')->get();

        return view('pages.sejarah', compact('sejarah'));
    }

    public function profil()
    {
        $pengurus = Pengurus::all();
        $profil = \App\Models\ProfilDesa::all()->pluck('value', 'key');

        return view('pages.profil', compact('pengurus', 'profil'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
}
