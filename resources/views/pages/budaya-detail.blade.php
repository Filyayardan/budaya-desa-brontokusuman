@extends('layouts.app')
@section('title', $budaya->judul . ' - Kebudayaan Brontokusuman')

@section('content')
<section class="header-section relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-main_txt-300 transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-main_txt-500/40"></i>
            <a href="{{ route('budaya') }}" class="hover:text-main_txt-300 transition-colors">Kebudayaan</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-main_txt-500/40"></i>
            <span class="text-main_txt-300">{{ $budaya->judul }}</span>
        </nav>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mb-4">{{ $budaya->judul }}</h1>
        <div class="flex items-center gap-4 text-black text-sm">
            <span class="bg-main_txt text-white text-xs font-bold px-3 py-1 rounded-full">{{ $budaya->kategori->nama_kategori ?? '-' }}</span>
            @if($budaya->lokasi)
            <span><i class="fas fa-map-marker-alt text-main_txt mr-1"></i>{{ $budaya->lokasi }}</span>
            @endif
        </div>
    </div>
</section>

<section class="py-16 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                @if($budaya->gambar)
                <div class="rounded-2xl overflow-hidden border border-gold-500/10 mb-8">
                    <img src="{{ asset('storage/' . $budaya->gambar) }}" alt="{{ $budaya->judul }}" class="w-full h-auto">
                </div>
                @endif

                @if($budaya->video)
                <div class="rounded-2xl overflow-hidden border border-gold-500/10 mb-8">
                    <video controls class="w-full h-auto" preload="metadata">
                        <source src="{{ asset('storage/' . $budaya->video) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
                @endif

                <div class="bg-second_bg backdrop-blur rounded-2xl border border-gold-500/10 p-8">
                    <h2 class="font-display text-2xl font-bold text-main_txt mb-6">Tentang {{ $budaya->judul }}</h2>
                    <div class="prose prose-invert max-w-none text-black leading-relaxed">
                        {!! nl2br(e($budaya->deskripsi_lengkap ?? $budaya->deskripsi)) !!}
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-second_bg backdrop-blur rounded-2xl border border-gold-500/10 p-6">
                    <h3 class="font-display text-lg font-bold text-main_txt mb-4">Informasi</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-main_txt-500/10 flex items-center justify-center"><i class="fas fa-tag text-main_txt-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Kategori</span><span class="text-black text-sm font-medium">{{ $budaya->kategori->nama_kategori ?? '-' }}</span></div>
                        </div>
                        @if($budaya->lokasi)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-main_txt-500/10 flex items-center justify-center"><i class="fas fa-map-marker-alt text-main_txt-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Lokasi</span><span class="text-black text-sm font-medium">{{ $budaya->lokasi }}</span></div>
                        </div>
                        @endif
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-main_txt-500/10 flex items-center justify-center"><i class="fas fa-clock text-main_txt-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Terakhir Diperbarui</span><span class="text-black text-sm font-medium">{{ $budaya->updated_at->translatedFormat('d M Y') }}</span></div>
                        </div>
                    </div>
                </div>

                @if($terkait->count())
                <div class="bg-second_bg backdrop-blur rounded-2xl border border-gold-500/10 p-6">
                    <h3 class="font-display text-lg font-bold text-main_txt mb-4">Budaya Terkait</h3>
                    <div class="space-y-4">
                        @foreach($terkait as $t)
                        <a href="{{ route('budaya.detail', $t->id) }}" class="flex items-center space-x-3 group">
                            <div class="w-14 h-14 rounded-xl border-[0.9px]  from-gold-600/20 to-dark-700 flex-shrink-0 overflow-hidden">
                                @if($t->gambar)
                                    <img src="{{ asset('storage/' . $t->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i class="fas fa-image text-gold-500/20"></i></div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-main_txt text-sm font-semibold group-hover:text-gold-300 transition-colors">{{ $t->judul }}</h4>
                                <span class="text-gray-500 text-xs">{{ $t->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
