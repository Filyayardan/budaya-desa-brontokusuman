@extends('admin.layouts.app')
@section('title', 'Edit Budaya')
@section('header', 'Edit Budaya')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form action="{{ route('admin.budaya.update', $budaya) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori_id" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id', $budaya->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $budaya->lokasi) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $budaya->judul) }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="3" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi', $budaya->deskripsi) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi_lengkap', $budaya->deskripsi_lengkap) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Posisi di Peta
                    </label>

                    <div id="map" class="w-full h-80 rounded-xl border border-gray-300"></div>

                    <input type="hidden" name="latitude" id="latitude"
                        value="{{ old('latitude', $budaya->latitude ?? -7.7956) }}">
                    <input type="hidden" name="longitude" id="longitude"
                        value="{{ old('longitude', $budaya->longitude ?? 110.3695) }}">

                    <p class="text-xs text-gray-500 mt-2">Klik peta untuk menentukan lokasi budaya.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        @if ($budaya->gambar)
                            <div class="mb-2"><img src="{{ asset('storage/' . $budaya->gambar) }}"
                                    class="w-20 h-20 rounded-lg object-cover"></div>
                        @endif
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                        @if ($budaya->video)
                            <div class="mb-2 text-xs text-green-600"><i class="fas fa-check-circle mr-1"></i>Video sudah
                                diupload</div>
                        @endif
                        <input type="file" name="video" accept="video/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                        <p class="text-xs text-gray-400 mt-1">MP4, WebM, MOV (maks 500MB)</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">Perbarui</button>
                    <a href="{{ route('admin.budaya.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
    
   
@endsection
