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
use App\Models\Umkm;
use App\Models\Visitor;
use App\Models\Faq;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {   
        $budayaUnggulan = Budaya::with('kategori')->where('unggulan', true)->limit(6)->get();
        $acaraTerbaru = Acara::orderBy('tanggal_mulai', 'desc')->limit(1)->get();
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')->limit(1)->get();
        $galeriTerbaru = Galeri::orderBy('created_at', 'desc')->limit(8)->get();
        $kategori = KategoriBudaya::withCount('budaya')->get();
        $banner = Banner::aktif()->first();

        //section pengunjung start
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate(
            'visited_at',
            today()
        )->count();
        // untuk menampilkan graf hanya jika ada pengunjung pada hari itu
        // $monthVisitors = Visitor::whereMonth('visited_at', now()->month)
        //     ->whereYear('visited_at', now()->year)
        //     ->count();
        // $visitorPerHari = DB::table('visitors')
        //     ->selectRaw('DATE(visited_at) as hari, COUNT(DISTINCT session_id) as jumlah')
        //     ->whereYear('visited_at', now()->year)
        //     ->whereMonth('visited_at', now()->month)
        //     ->groupByRaw('DATE(visited_at)')
        //     ->orderBy('hari')
        //     ->get();
        // $visitorLabels = $visitorPerHari->pluck('hari')->toArray();
        // $visitorData = $visitorPerHari
        //     ->pluck('jumlah')
        //     ->map(fn($jumlah) => (int) $jumlah)
        //     ->toArray();
        // $rangeVisitors = 0;

        // untuk menampilkan graf sebulan penuh maupun tidak pengunjung
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate('visited_at', today())->count();

        $monthVisitors = Visitor::whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year)
            ->count();

        // 1. Ambil data agregat dari DB dan jadikan associative array [ 'YYYY-MM-DD' => jumlah ]
        $visitorMap = DB::table('visitors')
            ->selectRaw('DATE(visited_at) as hari, COUNT(DISTINCT session_id) as jumlah')
            ->whereYear('visited_at', now()->year)
            ->whereMonth('visited_at', now()->month)
            ->groupByRaw('DATE(visited_at)')
            ->pluck('jumlah', 'hari')
            ->toArray();

        // 2. Generate seluruh tanggal di bulan ini (tanggal 1 s.d. tanggal terakhir)
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $period = \Carbon\CarbonPeriod::create($startOfMonth, $endOfMonth);

        $visitorLabels = [];
        $visitorData = [];

        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d'); // Cocokkan format key dengan DATE(visited_at)

            $visitorLabels[] = $date->format('d'); // Format label: "01", "02", dst.
            $visitorData[] = (int) ($visitorMap[$dateKey] ?? 0); // Isi 0 jika tidak ada kunjungan
        }

        $rangeVisitors = 0;

        
        //section pengunjung end

        $umkm = Umkm::whereNotNull('latitude')->whereNotNull('longitude')->get()->map(fn($u) => [
            'nama' => $u->nama_usaha,
            'kategori' => $u->kategori ?? 'UMKM',
            'lokasi' => $u->alamat,
            'deskripsi' => Str::limit($u->deskripsi, 100),
            'lat' => (float) $u->latitude,
            'lng' => (float) $u->longitude,
            'url' => null,
        ])->values();

        $budaya = Budaya::with('kategori')->whereNotNull('latitude')->whereNotNull('longitude')->get()->map(fn($b) => [
            'nama' => $b->judul,
            'kategori' => $b->kategori->nama_kategori ?? 'Budaya',
            'lokasi' => $b->lokasi,
            'deskripsi' => Str::limit($b->deskripsi, 100),
            'lat' => (float) $b->latitude,
            'lng' => (float) $b->longitude,
            'url' => route('budaya.detail', $b->id),
        ])->values();

        $acara = Acara::whereNotNull('latitude')->whereNotNull('longitude')
            ->get()
            ->reject(fn($a) => $a->status === 'completed')
            ->map(fn($a) => [
                'nama' => $a->nama_acara,
                'kategori' => 'Acara',
                'lokasi' => $a->lokasi,
                'deskripsi' => Str::limit($a->deskripsi, 100),
                'lat' => (float) $a->latitude,
                'lng' => (float) $a->longitude,
                'status' => $a->status,
                'url' => route('acara.detail', $a->id),
            ])->values();

        return view('welcome', compact('budayaUnggulan', 'acaraTerbaru', 'beritaTerbaru', 'galeriTerbaru', 'kategori', 'banner', 'umkm', 'budaya', 'acara',    'totalVisitors',
            'visitorLabels',
            'todayVisitors',
            'visitorData'));
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

    public function peta()
    {
        $umkm = Umkm::whereNotNull('latitude')->whereNotNull('longitude')->get()->map(fn ($u) => [
            'nama' => $u->nama_usaha,
            'kategori' => $u->kategori ?? 'UMKM',
            'lokasi' => $u->alamat,
            'deskripsi' => Str::limit($u->deskripsi, 100),
            'lat' => (float) $u->latitude,
            'lng' => (float) $u->longitude,
            'url' => null,
        ])->values();

        $budaya = Budaya::with('kategori')->whereNotNull('latitude')->whereNotNull('longitude')->get()->map(fn ($b) => [
            'nama' => $b->judul,
            'kategori' => $b->kategori->nama_kategori ?? 'Budaya',
            'lokasi' => $b->lokasi,
            'deskripsi' => Str::limit($b->deskripsi, 100),
            'lat' => (float) $b->latitude,
            'lng' => (float) $b->longitude,
            'url' => route('budaya.detail', $b->id),
        ])->values();

        $acara = Acara::whereNotNull('latitude')->whereNotNull('longitude')
            ->get()
            ->reject(fn ($a) => $a->status === 'completed')
            ->map(fn ($a) => [
                'nama' => $a->nama_acara,
                'kategori' => 'Acara',
                'lokasi' => $a->lokasi,
                'deskripsi' => Str::limit($a->deskripsi, 100),
                'lat' => (float) $a->latitude,
                'lng' => (float) $a->longitude,
                'status' => $a->status,
                'url' => route('acara.detail', $a->id),
            ])->values();

        return view('pages.peta', compact('umkm', 'budaya', 'acara'));
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
        $profil = \App\Models\ProfilKampung::all()->pluck('value', 'key');

        return view('pages.profil', compact('pengurus', 'profil'));
    }

    public function kontak()
    {
        $faqs = Faq::all();
        return view('pages.kontak',compact('faqs'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        // $budaya = Budaya::with('kategori')->latest()->paginate(12);

        return view('pages.faq', compact('faqs'));
    }
}
