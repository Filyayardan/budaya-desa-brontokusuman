@extends('layouts.app')
@section('title', 'Acara Budaya - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Agenda</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Acara Budaya</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Jadwal dan informasi acara kebudayaan di Kampung Brontokusuman</p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($acara->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($acara as $a)
                        <a href="{{ route('acara.detail', $a->id) }}" class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                                <div class="relative h-52 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                                    @if ($a->gambar)
                                        <img src="{{ asset('storage/' . $a->gambar) }}" alt="{{ $a->nama_acara }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center"><i
                                                class="fas fa-calendar-day text-5xl text-gold-500/20"></i></div>
                                    @endif
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="bg-dark-900/80 backdrop-blur text-gold-300 text-xs font-bold px-3 py-1 rounded-full border border-gold-500/20">
                                            {{ \Carbon\Carbon::parse($a->tanggal_mulai)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="absolute bottom-4 left-4">
                                        <span
                                            class="text-xs font-semibold px-3 py-1 rounded-full
                                {{ $a->status === 'upcoming' ? 'bg-blue-500/20 text-blue-300 border border-blue-500/30' : ($a->status === 'ongoing' ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-gray-500/20 text-gray-300 border border-gray-500/30') }}">
                                            {{ $a->status === 'upcoming' ? 'Mendatang' : ($a->status === 'ongoing' ? 'Berlangsung' : 'Selesai') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="font-display text-xl font-bold text-main_txt group-hover:text-gold-300 transition-colors mb-3">
                                        {{ $a->nama_acara }}</h3>
                                    <p class="text-tertiary text-sm line-clamp-2 mb-4">{{ Str::limit($a->deskripsi, 120) }}
                                    </p>
                                    @if ($a->lokasi)
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-map-marker-alt text-gold-500/60 mr-2"></i>{{ $a->lokasi }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">{{ $acara->links('vendor.pagination.tailwind') }}</div>
                <div class="px-4">
                    <h1>Map Desa</h1>

                    <div id="map" class="z-0"></div>

                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

                    <script>
                        const statusClassMap = {
                            upcoming: 'bg-blue-500/20 text-blue-300 border border-blue-500/30',
                            ongoing: 'bg-green-500/20 text-green-300 border border-green-500/30',
                          
                        };

                        
                        const statusConfig = {
                            upcoming: {
                                color: '#8EC5FF',
                                label: 'Mendatang'
                            },
                            ongoing: {
                                color: '#22c55e',
                                label: 'Berlangsung'
                            },
                            
                            
                        };
                        
                        const acara = @json($acara);
                    
                        // Koordinat awal
                        const map = L.map('map').setView([-7.7956, 110.3695], 13);
                        
                        // OpenStreetMap
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);
                        
                        // Marker
                        
                        function createIcon(status) {
                            const color = statusConfig[status].color || '#4287f5';
                            console.log(color)
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
                            acara.data.forEach(acar => {
                                if (!acar.latitude || !acar.longitude) return; // Skip jika tidak ada koordinat
                            console.log(acar)
                            const popupClass = statusClassMap[acar.status] || 'bg-gray-500/20 text-gray-300 border border-gray-500/30';
                            
                            const lat = parseFloat(acar.latitude);
                            const lng = parseFloat(acar.longitude);
                            
                           
                            if (isNaN(lat) || isNaN(lng)) return;
                            
                            const marker = L.marker([acar.latitude, acar.longitude], {
                                icon: createIcon(acar.status)
                            }).addTo(map);

                            marker.bindPopup(`
      <div class="text-center flex flex-col gap-1  items-center" >
            <p class="font-body text-[10px]  text-tertiary font-bold ${popupClass} w-fit px-2 py-1 rounded-2xl " style="margin: 0;">${acar.status}</p>
            <p class="font-display text-main_txt text-2xl " style="margin: 0;"><b>${acar.nama_acara || 'Tanpa Judul'}</b></p>
            ${acar.lokasi ? `<p class="text-[10px] text-tertiary m-0 font-bold" style="margin: 0;">Lokasi : ${acar.lokasi}</p>` : ''}
        </div>
    `);
                        });
                    </script>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-calendar-times text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-gray-400 text-lg">Belum ada acara budaya.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
