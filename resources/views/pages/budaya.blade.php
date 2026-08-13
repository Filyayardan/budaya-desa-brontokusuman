@extends('layouts.app')
@section('title', 'Kebudayaan Kampung Brontokusuman')

@section('content')
    <section class="header-section  relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Koleksi</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Kebudayaan</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Beragam warisan budaya yang dilestarikan di Kampung Brontokusuman
            </p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center mb-12">
                <a href="{{ route('budaya') }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium {{ !isset($kategoriAktif) ? 'gradient-gold text-dark-950' : 'bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10' }} transition-all">
                    Semua
                </a>
                @foreach ($kategori as $k)
                    <a href="{{ route('budaya.kategori', $k->id) }}"
                        class="px-5 py-2.5 rounded-full text-sm font-medium {{ isset($kategoriAktif) && $kategoriAktif->id == $k->id ? 'gradient-gold text-dark-950' : 'bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10' }} transition-all">
                        {{ $k->nama_kategori }}
                    </a>
                @endforeach
            </div>

            @if ($budaya->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($budaya as $b)
                        <a href="{{ route('budaya.detail', $b->id) }}" class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                                <div
                                    class="relative aspect-[3/2]  bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                                    @if ($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-image text-5xl text-gold-500/20"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="gradient-gold text-dark-950 text-xs font-bold px-3 py-1 rounded-full">{{ $b->kategori->nama_kategori ?? '-' }}</span>
                                    </div>
                                    @if ($b->unggulan)
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="bg-dark-900/80 text-gold-300 text-xs font-bold px-3 py-1 rounded-full border border-gold-500/20"><i
                                                    class="fas fa-star mr-1"></i>Unggulan</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="font-display text-xl font-bold text-main_txt group-hover:text-gold-300 transition-colors mb-3">
                                        {{ $b->judul }}</h3>
                                    <p class="text-tertiary text-sm line-clamp-2 mb-4">{{ Str::limit($b->deskripsi, 120) }}
                                    </p>
                                    @if ($b->lokasi)
                                        <div class="flex items-center text-gray-700 text-sm">
                                            <i class="fas fa-map-marker-alt text-gold-500/60 mr-2"></i>{{ $b->lokasi }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $budaya->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
                <div class="px-4">
                    <h1>Map Desa</h1>

                    <div id="map" class="z-0"></div>

                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

                    <script>
                        const budaya = @json($budaya)

                        // Koordinat awal
                        const map = L.map('map').setView([-7.7956, 110.3695], 13);

                        // OpenStreetMap
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);

                        // Marker

                        function createIcon() {
                            const color = '#4287f5';
                            return L.divIcon({
                                html: `
            <svg width="28" height="36" viewBox="0 0 28 36" fill="none">
                <path d="M14 0C6.27 0 0 6.27 0 14c0 10.5 14 22 14 22s14-11.5 14-22C28 6.27 21.73 0 14 0z" fill="${color}"/>
                <circle cx="14" cy="14" r="6" fill="white"/>
            </svg>
        `,
                                iconSize: [28, 36],
                                iconAnchor: [14, 36],
                                popupAnchor: [0, -38],
                                className: ''
                            });
                        }

                        // Render semua marker
                        budaya.data.forEach(bud => {
                            if (!bud.latitude || !bud.longitude) return; // Skip jika tidak ada koordinat
                        
                            const lat = parseFloat(bud.latitude);
                            const lng = parseFloat(bud.longitude);

                            // 2. Pastikan hasil parse valid (bukan NaN)
                            if (isNaN(lat) || isNaN(lng)) return;

                            const marker = L.marker([bud.latitude, bud.longitude], {
                                icon: createIcon()
                            }).addTo(map);

                            marker.bindPopup(`
      <div class="text-center flex flex-col gap-1  items-center" >
            <p class="font-body text-[10px]  text-white font-bold bg-main_txt w-fit px-2 py-1 rounded-2xl " style="margin: 0;">${bud.kategori.nama_kategori}</p>
            <p class="font-display text-main_txt text-2xl " style="margin: 0;"><b>${bud.judul || 'Tanpa Judul'}</b></p>
            ${bud.lokasi ? `<p class="text-[10px] text-tertiary m-0 font-bold" style="margin: 0;">Lokasi : ${bud.lokasi}</p>` : ''}
        </div>
    `);
                        });
                    </script>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-inbox text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-gray-400 text-lg">Belum ada data kebudayaan.</p>
                </div>
            @endif
        </div>

    </section>
@endsection
