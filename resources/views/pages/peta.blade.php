@extends('layouts.app')
@section('title', 'Peta Kampung Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Jelajahi</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Peta Kampung</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Temukan lokasi UMKM, kebudayaan, dan acara di Kampung
                Brontokusuman</p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center mb-8">
                <button data-filter="all"
                    class="filter-btn active px-5 py-2.5 rounded-full text-sm font-medium transition-all">Semua</button>
                <button data-filter="umkm"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-store mr-2"></i>UMKM</button>
                <button data-filter="budaya"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-landmark mr-2"></i>Budaya</button>
                <button data-filter="acara"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-calendar-alt mr-2"></i>Acara</button>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gold-500/10 shadow-lg">
                <div id="map" style="height: 600px; width: 100%;"></div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-6 mt-8 text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#2e7d32;"></span>
                    <span class="text-gray-700 font-medium">UMKM</span>
                    <span class="text-gray-400">({{ count($umkm) }})</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#b8860b;"></span>
                    <span class="text-gray-700 font-medium">Budaya</span>
                    <span class="text-gray-400">({{ count($budaya) }})</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#1565c0;"></span>
                    <span class="text-gray-700 font-medium">Acara</span>
                    <span class="text-gray-400">({{ $acara->where('status', '!=', 'ongoing')->count() }})</span>
                </div>
                @if($acara->contains('status', 'ongoing'))
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 rounded-full animate-pulse" style="background:#22c55e;"></span>
                        <span class="text-gray-700 font-medium">Acara Berlangsung</span>
                        <span class="text-gray-400">({{ $acara->where('status', 'ongoing')->count() }})</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .filter-btn {
                background: #2d2b33;
                color: #9f9da7;
                border: 1px solid rgba(212, 160, 23, 0.1);
            }

            .filter-btn:hover {
                background: rgba(212, 160, 23, 0.1);
                color: #b8860b;
            }

            .filter-btn.active {
                background: linear-gradient(135deg, #d4a017 0%, #f5de8c 50%, #d4a017 100%);
                color: #1a1820;
                border-color: transparent;
                font-weight: 700;
            }

            .peta-divicon {
                background: transparent;
                border: none;
            }

            .peta-pin {
                width: 36px;
                height: 36px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
                border: 2px solid rgba(255, 255, 255, 0.9);
            }

            .peta-pin i {
                transform: rotate(45deg);
                color: #fff;
                font-size: 14px;
            }

            .peta-popup a:hover {
                text-decoration: underline;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            const petaData = {
                umkm: @json($umkm),
                budaya: @json($budaya),
                acara: @json($acara),
            };

            const markerConf = {
                umkm: { color: '#2e7d32', icon: 'fa-store', label: 'UMKM' },
                budaya: { color: '#b8860b', icon: 'fa-landmark', label: 'Budaya' },
                acara: { color: '#1565c0', icon: 'fa-calendar-alt', label: 'Acara' },
            };

            function esc(s) {
                return String(s == null ? '' : s).replace(/[&<>"']/g, c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                }[c]));
            }

            function colorFor(type, item) {
                if (type === 'acara' && item.status === 'ongoing') {
                    return '#22c55e';
                }
                return markerConf[type].color;
            }

            function iconFor(type, item) {
                const c = markerConf[type];
                return L.divIcon({
                    className: 'peta-divicon',
                    html: `<div class="peta-pin" style="background:${colorFor(type, item)};"><i class="fas ${c.icon}"></i></div>`,
                    iconSize: [36, 42],
                    iconAnchor: [18, 42],
                    popupAnchor: [0, -40],
                });
            }

            function popupContent(item, type) {
                const c = markerConf[type];
                const color = colorFor(type, item);
                return `
                    <div class="peta-popup" style="font-family:Inter,sans-serif;min-width:200px;">
                        <span class="text-xs font-semibold uppercase tracking-wider" style="color:${color};">${c.label} · ${esc(item.kategori)}</span>
                        <h4 class="font-bold text-base mt-1 mb-1" style="color:#331006;">${esc(item.nama)}</h4>
                        ${item.lokasi ? `<p class="text-xs mb-1" style="color:#615f6c;"><i class="fas fa-map-marker-alt mr-1"></i>${esc(item.lokasi)}</p>` : ''}
                        ${item.deskripsi ? `<p class="text-xs leading-relaxed" style="color:#4d4b56;">${esc(item.deskripsi)}</p>` : ''}
                        ${item.url ? `<a href="${esc(item.url)}" class="inline-block mt-2 text-xs font-bold" style="color:#8f2a1c;">Lihat Detail &rarr;</a>` : ''}
                    </div>`;
            }

            const map = L.map('map').setView([-7.8170, 110.3703], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const groups = {};
            const allBounds = [];

            Object.keys(petaData).forEach(type => {
                groups[type] = L.layerGroup();
                petaData[type].forEach(item => {
                    const lat = parseFloat(item.lat);
                    const lng = parseFloat(item.lng);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        L.marker([lat, lng], { icon: iconFor(type, item) })
                            .bindPopup(popupContent(item, type))
                            .addTo(groups[type]);
                        allBounds.push([lat, lng]);
                    }
                });
                groups[type].addTo(map);
            });

            if (allBounds.length) {
                map.fitBounds(L.latLngBounds(allBounds).pad(0.25));
            }

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const f = btn.dataset.filter;
                    Object.keys(groups).forEach(type => {
                        if (f === 'all' || f === type) {
                            map.addLayer(groups[type]);
                        } else {
                            map.removeLayer(groups[type]);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
