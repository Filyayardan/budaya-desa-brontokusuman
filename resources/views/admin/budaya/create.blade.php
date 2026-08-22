@extends('admin.layouts.app')
@section('title', 'Tambah Budaya')
@section('header', 'Tambah Budaya')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form action="{{ route('admin.budaya.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori_id" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="3" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi_lengkap') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Posisi di Peta
                    </label>

                    <div id="map" class="w-full h-80 rounded-xl border border-gray-300"></div>

                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Latitude</label>
                            <input type="text" name="latitude" id="latitude"
                                value="{{ old('latitude', $budaya->latitude ?? '') }}"
                                placeholder="contoh: -7.8164907"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Longitude</label>
                            <input type="text" name="longitude" id="longitude"
                                value="{{ old('longitude', $budaya->longitude ?? '') }}"
                                placeholder="contoh: 110.3718611"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">Klik peta atau masukkan koordinat secara manual.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                        <input type="file" name="video" accept="video/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                        <p class="text-xs text-gray-400 mt-1">MP4, WebM, MOV (maks 500MB)</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">Simpan</button>
                    <a href="{{ route('admin.budaya.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        const defaultLat = {{ old('latitude', $budaya->latitude ?? -7.7956) }};
        const defaultLng = {{ old('longitude', $budaya->longitude ?? 110.3695) }};

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = null;

        if (latInput.value && lngInput.value) {
            marker = L.marker([latInput.value, lngInput.value]).addTo(map);
            map.setView([latInput.value, lngInput.value], 16);
        }

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
    </script>
@endsection
