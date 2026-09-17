@extends('layouts.app')
@section('title', 'UMKM Kampung Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Ekonomi Warga</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">UMKM</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Produk dan usaha warga Kampung Brontokusuman</p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($kategori->count())
                <div class="flex flex-wrap gap-3 justify-center mb-12">
                    <a href="{{ route('umkm') }}"
                        class="px-5 py-2.5 rounded-full text-sm font-medium {{ !request('kategori') ? 'gradient-gold text-dark-950' : 'bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10' }} transition-all">
                        Semua
                    </a>
                    @foreach ($kategori as $k)
                        <a href="{{ route('umkm', ['kategori' => $k]) }}"
                            class="px-5 py-2.5 rounded-full text-sm font-medium {{ request('kategori') === $k ? 'gradient-gold text-dark-950' : 'bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10' }} transition-all">
                            {{ $k }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($umkm->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($umkm as $u)
                        <div class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-md overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full flex flex-col">
                                <div class="relative aspect-[3/2] bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-store text-5xl text-gold-500/30"></i>
                                    </div>
                                    @if ($u->kategori)
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="gradient-gold text-dark-950 text-xs font-bold px-3 py-1 rounded-full">{{ $u->kategori }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 flex flex-col flex-1">
                                    <h3 class="font-display text-xl font-bold text-main_txt mb-1">{{ $u->nama_usaha }}</h3>
                                    @if ($u->pemilik)
                                        <p class="text-tertiary text-sm mb-3"><i
                                                class="fas fa-user text-gold-500/60 mr-2"></i>{{ $u->pemilik }}</p>
                                    @endif
                                    @if ($u->deskripsi)
                                        <p class="text-tertiary text-sm line-clamp-3 mb-4">
                                            {{ Str::limit($u->deskripsi, 140) }}</p>
                                    @endif
                                    <div class="mt-auto space-y-2">
                                        @if ($u->alamat)
                                            <div class="flex items-start text-gray-700 text-sm">
                                                <i class="fas fa-map-marker-alt text-gold-500/60 mr-2 mt-1"></i>
                                                <span>{{ $u->alamat }}</span>
                                            </div>
                                        @endif
                                        @if ($u->kontak)
                                            <div class="flex items-center text-gray-700 text-sm">
                                                <i class="fas fa-phone text-gold-500/60 mr-2"></i>
                                                <span>{{ $u->kontak }}</span>
                                            </div>
                                        @endif
                                        @if ($u->latitude && $u->longitude)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $u->latitude }},{{ $u->longitude }}"
                                                target="_blank" rel="noopener"
                                                class="inline-flex items-center text-sm font-medium text-main_txt hover:text-gold-600 transition-colors">
                                                <i class="fas fa-location-arrow mr-2"></i>Lihat Lokasi
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $umkm->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-store text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-gray-400 text-lg">Belum ada data UMKM.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
