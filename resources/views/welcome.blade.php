@extends('layouts.app')

@section('title', 'Beranda - Kebudayaan Desa Brontokusuman')

@section('content')
<section class="relative min-h-screen flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-950 via-dark-900 to-dark-950"></div>
    <div class="absolute inset-0 hero-pattern opacity-30"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gold-600/5 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-flex items-center space-x-2 bg-gold-500/10 border border-gold-500/20 rounded-full px-5 py-2 mb-8">
                    <span class="w-2 h-2 bg-gold-400 rounded-full animate-pulse"></span>
                    <span class="text-gold-300 text-sm font-medium tracking-wide">Warisan Budaya Yogyakarta</span>
                </div>

                <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-8">
                    <span class="text-white">Jelajahi</span><br>
                    <span class="text-gradient-gold">Kebudayaan</span><br>
                    <span class="text-white">Brontokusuman</span>
                </h1>

                <p class="text-gray-400 text-lg leading-relaxed mb-10 max-w-xl">
                    Mengenal lebih dekat keindahan tradisi, seni, dan warisan budaya Desa Brontokusuman yang telah mengakar sejak berabad-abad lamanya.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('budaya') }}" class="gradient-gold text-dark-950 font-semibold px-8 py-4 rounded-xl hover:opacity-90 transition-opacity text-center shadow-lg shadow-gold-500/20">
                        <i class="fas fa-compass mr-2"></i>Jelajahi Budaya
                    </a>
                    <a href="{{ route('sejarah') }}" class="border border-gold-500/30 text-gold-300 font-semibold px-8 py-4 rounded-xl hover:bg-gold-500/10 transition-colors text-center">
                        <i class="fas fa-book-open mr-2"></i>Sejarah Desa
                    </a>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="relative w-full h-[500px] rounded-2xl overflow-hidden border border-gold-500/20 shadow-2xl shadow-gold-500/10">
                    <div class="absolute inset-0 bg-gradient-to-br from-gold-600/20 to-dark-900/80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-masks-theater text-8xl text-gold-400/40 mb-4"></i>
                            <p class="text-gold-300/60 font-display text-xl">Seni & Tradisi</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 gradient-gold rounded-2xl flex items-center justify-center shadow-xl">
                    <div class="text-center">
                        <span class="block text-3xl font-bold text-dark-950 font-display">{{ $kategori->count() }}</span>
                        <span class="text-dark-800 text-xs font-medium">Kategori</span>
                    </div>
                </div>
                <div class="absolute -top-6 -right-6 w-40 bg-dark-800/90 backdrop-blur-xl rounded-2xl p-5 border border-gold-500/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-gold-500/10 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-gold-400 text-xl"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold text-white font-display">{{ $acaraTerbaru->count() }}</span>
                            <span class="text-gray-400 text-xs">Acara Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-dark-950 to-transparent"></div>
</section>

<section class="py-8 bg-dark-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @php $stats = [['icon'=>'fa-landmark','count'=>$kategori->count(),'label'=>'Kategori Budaya'],['icon'=>'fa-scroll','count'=>App\Models\Budaya::count(),'label'=>'Item Budaya'],['icon'=>'fa-calendar-check','count'=>App\Models\Acara::count(),'label'=>'Acara Budaya'],['icon'=>'fa-images','count'=>App\Models\Galeri::count(),'label'=>'Foto Galeri']]; @endphp
            @foreach($stats as $s)
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gold-500/10 flex items-center justify-center group-hover:bg-gold-500/20 transition-colors">
                    <i class="fas {{ $s['icon'] }} text-gold-400 text-2xl"></i>
                </div>
                <span class="block text-3xl font-bold font-display text-white mb-1">{{ $s['count'] }}</span>
                <span class="text-gray-500 text-sm">{{ $s['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if($kategori->count())
<section class="py-24 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Kategori</span>
            <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mt-3 mb-4">Jenis Kebudayaan</h2>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-gray-400 max-w-2xl mx-auto">Beragam warisan budaya yang dilestarikan di Desa Brontokusuman</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($kategori as $k)
            <a href="{{ route('budaya.kategori', $k->id) }}" class="card-hover group">
                <div class="bg-dark-800/80 backdrop-blur border border-gold-500/10 rounded-2xl p-6 text-center h-full hover:border-gold-500/30">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gold-500/10 flex items-center justify-center group-hover:bg-gold-500/20 transition-colors">
                        <i class="fas {{ $k->ikon ?? 'fa-landmark' }} text-gold-400 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">{{ $k->nama_kategori }}</h3>
                    <p class="text-gray-500 text-xs">{{ $k->budaya_count }} item</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($budayaUnggulan->count())
<section class="py-24 bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
            <div>
                <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Unggulan</span>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mt-3">Kebudayaan Pilihan</h2>
                <div class="line-gold w-24 mt-4"></div>
            </div>
            <a href="{{ route('budaya') }}" class="mt-6 md:mt-0 text-gold-400 hover:text-gold-300 font-medium text-sm transition-colors">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($budayaUnggulan as $b)
            <a href="{{ route('budaya.detail', $b->id) }}" class="card-hover group">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                    <div class="relative h-56 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                        @if($b->gambar)
                            <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-image text-5xl text-gold-500/20"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="gradient-gold text-dark-950 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $b->kategori->nama_kategori ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-white group-hover:text-gold-300 transition-colors mb-3">{{ $b->judul }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ Str::limit($b->deskripsi, 120) }}</p>
                        @if($b->lokasi)
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-map-marker-alt text-gold-500/60 mr-2"></i>{{ $b->lokasi }}
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($acaraTerbaru->count())
<section class="py-24 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
            <div>
                <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Agenda</span>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mt-3">Acara Budaya</h2>
                <div class="line-gold w-24 mt-4"></div>
            </div>
            <a href="{{ route('acara') }}" class="mt-6 md:mt-0 text-gold-400 hover:text-gold-300 font-medium text-sm transition-colors">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($acaraTerbaru as $a)
            <a href="{{ route('acara.detail', $a->id) }}" class="card-hover group">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                    <div class="relative h-48 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                        @if($a->gambar)
                            <img src="{{ asset('storage/' . $a->gambar) }}" alt="{{ $a->nama_acara }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-calendar-day text-5xl text-gold-500/20"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-dark-900/80 backdrop-blur text-gold-300 text-xs font-bold px-3 py-1 rounded-full border border-gold-500/20">
                                {{ \Carbon\Carbon::parse($a->tanggal_mulai)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-white group-hover:text-gold-300 transition-colors mb-3">{{ $a->nama_acara }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ Str::limit($a->deskripsi, 120) }}</p>
                        <div class="flex items-center justify-between">
                            @if($a->lokasi)
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="fas fa-map-marker-alt text-gold-500/60 mr-2"></i>{{ Str::limit($a->lokasi, 30) }}
                            </div>
                            @endif
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                {{ $a->status === 'upcoming' ? 'bg-blue-500/10 text-blue-400' : ($a->status === 'ongoing' ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-400') }}">
                                {{ $a->status === 'upcoming' ? 'Mendatang' : ($a->status === 'ongoing' ? 'Berlangsung' : 'Selesai') }}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($galeriTerbaru->count())
<section class="py-24 bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
            <div>
                <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Dokumentasi</span>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mt-3">Galeri Foto</h2>
                <div class="line-gold w-24 mt-4"></div>
            </div>
            <a href="{{ route('galeri') }}" class="mt-6 md:mt-0 text-gold-400 hover:text-gold-300 font-medium text-sm transition-colors">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galeriTerbaru as $g)
            <div class="group relative rounded-xl overflow-hidden aspect-square card-hover cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-gold-600/20 to-dark-800">
                    @if($g->gambar)
                        <img src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gold-500/20"></i>
                        </div>
                    @endif
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <p class="text-white font-semibold text-sm">{{ $g->judul }}</p>
                    @if($g->kategori)
                    <p class="text-gold-300 text-xs mt-1">{{ $g->kategori }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($beritaTerbaru->count())
<section class="py-24 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
            <div>
                <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Informasi</span>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-white mt-3">Berita Terbaru</h2>
                <div class="line-gold w-24 mt-4"></div>
            </div>
            <a href="{{ route('berita') }}" class="mt-6 md:mt-0 text-gold-400 hover:text-gold-300 font-medium text-sm transition-colors">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($beritaTerbaru as $br)
            <a href="{{ route('berita.detail', $br->id) }}" class="card-hover group">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                    <div class="relative h-48 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                        @if($br->gambar)
                            <img src="{{ asset('storage/' . $br->gambar) }}" alt="{{ $br->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-newspaper text-5xl text-gold-500/20"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-xs mb-3">
                            <i class="far fa-clock mr-1"></i>
                            {{ $br->created_at->translatedFormat('d M Y') }}
                            @if($br->penulis)
                            <span class="mx-2">•</span>
                            <i class="far fa-user mr-1"></i>{{ $br->penulis }}
                            @endif
                        </div>
                        <h3 class="font-display text-xl font-bold text-white group-hover:text-gold-300 transition-colors mb-3">{{ $br->judul }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2">{{ Str::limit($br->ringkasan ?? $br->isi, 120) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-24 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-gold-600/5 via-transparent to-gold-600/5"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <i class="fas fa-quote-left text-gold-500/30 text-5xl mb-8"></i>
        <blockquote class="font-display text-3xl sm:text-4xl font-bold text-white leading-relaxed mb-8">
            "Budaya adalah identitas kita. Melestarikan budaya berarti menjaga jati diri bangsa."
        </blockquote>
        <div class="line-gold w-24 mx-auto mb-6"></div>
        <p class="text-gold-400 font-semibold">Desa Brontokusuman</p>
        <p class="text-gray-500 text-sm">Kecamatan Mergangsan, Kota Yogyakarta</p>
    </div>
</section>
@endsection
