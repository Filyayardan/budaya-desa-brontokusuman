@extends('admin.layouts.app')
@section('title', 'Edit Banner')
@section('header', 'Edit Banner')

@section('content')
<form action="{{ route('admin.banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-info-circle text-gold-500 mr-2"></i>Informasi Banner</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Badge Teks <span class="text-gray-400">(opsional)</span></label>
                    <input type="text" name="badge" value="{{ old('badge', $banner->badge) }}" placeholder="Warisan Budaya Yogyakarta" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Baris 1</label>
                        <input type="text" name="judul_atas" value="{{ old('judul_atas', $banner->judul_atas) }}" placeholder="Jelajahi" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Baris 2</label>
                        <input type="text" name="judul_tengah" value="{{ old('judul_tengah', $banner->judul_tengah) }}" placeholder="Kebudayaan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Baris 3</label>
                        <input type="text" name="judul_bawah" value="{{ old('judul_bawah', $banner->judul_bawah) }}" placeholder="Brontokusuman" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-gray-400">(opsional)</span></label>
                    <textarea name="deskripsi" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none" placeholder="Mengenal lebih dekat keindahan tradisi...">{{ old('deskripsi', $banner->deskripsi) }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol 1 Teks</label>
                        <input type="text" name="btn1_teks" value="{{ old('btn1_teks', $banner->btn1_teks) }}" placeholder="Jelajahi Budaya" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol 1 Link (route name)</label>
                        <input type="text" name="btn1_link" value="{{ old('btn1_link', $banner->btn1_link) }}" placeholder="budaya" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol 2 Teks</label>
                        <input type="text" name="btn2_teks" value="{{ old('btn2_teks', $banner->btn2_teks) }}" placeholder="Sejarah Desa" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tombol 2 Link (route name)</label>
                        <input type="text" name="btn2_link" value="{{ old('btn2_link', $banner->btn2_link) }}" placeholder="sejarah" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-image text-gold-500 mr-2"></i>Gambar & Status</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                    @if($banner->gambar)
                        <img src="{{ asset('storage/' . $banner->gambar) }}" class="w-full h-32 rounded-lg object-cover mb-3">
                    @else
                        <p class="text-gray-400 text-sm mb-3">Belum ada gambar.</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar <span class="text-gray-400">(opsional)</span></label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 5MB.</p>
                </div>
                <div>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="aktif" value="1" {{ old('aktif', $banner->aktif) ? 'checked' : '' }} class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <span class="text-sm text-gray-700">Tampilkan di beranda</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <a href="{{ route('admin.banner.index') }}" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium text-center hover:bg-gray-50">Batal</a>
                <button type="submit" class="flex-1 px-4 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
