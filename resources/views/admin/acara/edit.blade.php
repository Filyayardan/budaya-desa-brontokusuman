@extends('admin.layouts.app')
@section('title', 'Edit Acara')
@section('header', 'Edit Acara')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.acara.update', $acara) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Acara <span class="text-red-500">*</span></label>
                <input type="text" name="nama_acara" value="{{ old('nama_acara', $acara->nama_acara) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="4" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi', $acara->deskripsi) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $acara->tanggal_mulai) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $acara->tanggal_selesai) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $acara->lokasi) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    @php $statusLabel = ['upcoming' => 'Mendatang', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai'][$acara->status]; ?>
                    <div class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                        <span class="inline-flex items-center gap-1 font-medium {{ $acara->status === 'upcoming' ? 'text-blue-600' : ($acara->status === 'ongoing' ? 'text-green-600' : 'text-gray-500') }}">
                            <i class="fas fa-circle text-[8px]"></i>{{ $statusLabel }}
                        </span>
                        <span class="text-gray-400 ml-1">(otomatis)</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Mendatang &rarr; Berlangsung &rarr; Selesai</p>
                </div>
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
                                value="{{ old('latitude', $acara->latitude ?? '') }}"
                                placeholder="contoh: -7.8164907"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Longitude</label>
                            <input type="text" name="longitude" id="longitude"
                                value="{{ old('longitude', $acara->longitude ?? '') }}"
                                placeholder="contoh: 110.3718611"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">Klik peta atau masukkan koordinat secara manual.</p>
                </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                @if($acara->gambar)
                <div class="mb-2"><img src="{{ asset('storage/' . $acara->gambar) }}" class="w-20 h-20 rounded-lg object-cover"></div>
                @endif
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">Perbarui</button>
                <a href="{{ route('admin.acara.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
