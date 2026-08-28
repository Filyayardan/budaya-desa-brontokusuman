<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Admin') - Brontokusuman</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            gold: {
                                50: '#fdf8e8',
                                100: '#faefc5',
                                200: '#f5de8c',
                                300: '#efc94b',
                                400: '#e8b923',
                                500: '#d4a017',
                                600: '#b8860b',
                                700: '#8b6508',
                                800: '#6b4e0a',
                                900: '#5a420d'
                            },
                            dark: {
                                50: '#f6f6f7',
                                100: '#e2e1e5',
                                200: '#c4c3ca',
                                300: '#9f9da7',
                                400: '#7b7986',
                                500: '#615f6c',
                                600: '#4d4b56',
                                700: '#3f3d47',
                                800: '#2d2b33',
                                900: '#1a1820',
                                950: '#0f0e14'
                            },
                        },
                    }
                }
            }
        </script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            #map {
                z-index: 0;
            }
        </style>
        @stack('styles')
    </head>

    <body class="bg-gray-50 min-h-screen">
        <div class="flex min-h-screen">
            <aside id="sidebar"
                class="w-64 bg-dark-900 text-white flex flex-col fixed h-full z-[1000] transition-transform -translate-x-full lg:translate-x-0">
                <div class="p-6 border-b border-gold-500/10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center"
                            style="background: linear-gradient(135deg, #d4a017, #f5de8c);">
                            <i class="fas fa-landmark text-dark-950 text-lg"></i>
                        </div>
                        <div>
                            <span class="font-bold text-gold-300">Admin Panel</span>
                            <span class="block text-xs text-gray-500">Brontokusuman</span>
                        </div>
                    </a>
                </div>

                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gold-500/10 text-gold-300' : 'text-gray-400 hover:bg-dark-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
                    </a>
                    <div class="pt-3 pb-1 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Konten
                    </div>
                    @php
                        $menu = [
                            'admin.kategori-budaya.*' => [
                                'label' => 'Kategori Budaya',
                                'icon' => 'fa-tags',
                                'route' => 'admin.kategori-budaya.index',
                            ],
                            'admin.budaya.*' => [
                                'label' => 'Budaya',
                                'icon' => 'fa-landmark',
                                'route' => 'admin.budaya.index',
                            ],
                            'admin.umkm.*' => ['label' => 'UMKM', 'icon' => 'fa-store', 'route' => 'admin.umkm.index'],
                            'admin.berita.*' => [
                                'label' => 'Berita',
                                'icon' => 'fa-newspaper',
                                'route' => 'admin.berita.index',
                            ],
                            'admin.acara.*' => [
                                'label' => 'Acara',
                                'icon' => 'fa-calendar-alt',
                                'route' => 'admin.acara.index',
                            ],
                            'admin.galeri.*' => [
                                'label' => 'Galeri',
                                'icon' => 'fa-images',
                                'route' => 'admin.galeri.index',
                            ],
                            'admin.sejarah.*' => [
                                'label' => 'Sejarah',
                                'icon' => 'fa-book',
                                'route' => 'admin.sejarah.index',
                            ],
                            'admin.pengurus.*' => [
                                'label' => 'Pengurus',
                                'icon' => 'fa-users',
                                'route' => 'admin.pengurus.index',
                            ],
                            'admin.banner.*' => [
                                'label' => 'Banner',
                                'icon' => 'fa-images',
                                'route' => 'admin.banner.index',
                            ],
                            'admin.profil.*' => [
                                'label' => 'Profil Kampung',
                                'icon' => 'fa-id-card',
                                'route' => 'admin.profil.index',
                            ],
                            'admin.faq.*' => [
                                'label' => 'FAQ',
                                'icon' => 'fa-question-circle',
                                'route' => 'admin.faq.index',
                            ],
                            'admin.pengunjung.*' => [
                                'label' => 'Pengunjung',
                                'icon' => 'fa-eye',
                                'route' => 'admin.pengunjung.index',
                            ],
                            'admin.user.*' => [
                                'label' => 'Kelola Subadmin',
                                'icon' => 'fa-user',
                                'route' => 'admin.userManagement.index',
                            ],
                        ];
                    @endphp
                    @foreach ($menu as $pattern => $item)
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs($pattern) ? 'bg-gold-500/10 text-gold-300' : 'text-gray-400 hover:bg-dark-800 hover:text-white' }}">
                            <i class="fas {{ $item['icon'] }} w-5"></i><span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="p-4 border-t border-gold-500/10">
                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-400 hover:bg-dark-800 hover:text-white">
                        <i class="fas fa-external-link-alt w-5"></i><span>Lihat Website</span>
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-400 hover:bg-red-500/10 hover:text-red-400">
                            <i class="fas fa-sign-out-alt w-5"></i><span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1 lg:ml-64">
                <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                    <div class="flex items-center justify-between px-6 py-4">
                        <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <div class="w-8 h-8 rounded-full bg-gold-500/10 flex items-center justify-center">
                                <i class="fas fa-user text-gold-600 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-6">
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                            <div class="flex items-center mb-2"><i
                                    class="fas fa-exclamation-circle mr-2"></i><strong>Terjadi kesalahan:</strong></div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>

        <script>
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const mapEl = document.getElementById('map');

            if (mapEl && latInput && lngInput) {
                const defaultLat = parseFloat(latInput.value) || -7.8170000;
                const defaultLng = parseFloat(lngInput.value) || 110.3703000;

                const map = L.map('map').setView([defaultLat, defaultLng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                let marker = null;

                function updateMarker(lat, lng) {
                    latInput.value = lat.toFixed(7);
                    lngInput.value = lng.toFixed(7);
                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng]).addTo(map);
                    }
                    marker.bindPopup(`Lat: ${lat.toFixed(6)}<br>Lng: ${lng.toFixed(6)}`).openPopup();
                }

                if (latInput.value && lngInput.value) {
                    marker = L.marker([latInput.value, lngInput.value]).addTo(map);
                    map.setView([latInput.value, lngInput.value], 16);
                }

                map.on('click', function(e) {
                    updateMarker(e.latlng.lat, e.latlng.lng);
                });

                let debounceTimer;

                function onCoordInput() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        const lat = parseFloat(latInput.value);
                        const lng = parseFloat(lngInput.value);
                        if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                            map.setView([lat, lng], 16);
                            updateMarker(lat, lng);
                        }
                    }, 500);
                }

                latInput.addEventListener('input', onCoordInput);
                lngInput.addEventListener('input', onCoordInput);
            }

            document.getElementById('sidebarToggle')?.addEventListener('click', () => {
                document.getElementById('sidebar').classList.toggle('-translate-x-full');
            });
        </script>
        @stack('scripts')

    </body>

</html>
