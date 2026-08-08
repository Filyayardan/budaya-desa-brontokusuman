@extends('admin.layouts.app')
@section('title', 'Profil Kampung')
@section('header', 'Edit Profil Kampung')

@section('content')
<form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-info-circle text-gold-500 mr-2"></i>Tentang Kampung</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="tentang_judul" value="{{ $profil['tentang_judul'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="tentang_isi" rows="5" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ $profil['tentang_isi'] ?? '' }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                @if($profil['gambar'] ?? null)
                <div class="mb-2"><img src="{{ asset('storage/' . $profil['gambar']) }}" class="w-24 h-24 rounded-lg object-cover"></div>
                @endif
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Halaman Login</label>
                <p class="text-xs text-gray-400 mb-2">Foto ini ditampilkan sebagai latar belakang pada halaman login admin.</p>
                @if($profil['foto_login'] ?? null)
                <div class="mb-2"><img src="{{ asset('storage/' . $profil['foto_login']) }}" class="w-full h-32 rounded-lg object-cover"></div>
                @endif
                <input type="file" name="foto_login" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-map-marker-alt text-gold-500 mr-2"></i>Informasi Kampung</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi / Kecamatan</label>
                    <input type="text" name="lokasi" value="{{ $profil['lokasi'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penduduk</label>
                    <input type="text" name="penduduk" value="{{ $profil['penduduk'] ?? '' }}" placeholder="± 3.000 Jiwa" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ $profil['kecamatan'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="kota" value="{{ $profil['kota'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-eye text-gold-500 mr-2"></i>Visi & Misi</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                <textarea name="visi" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ $profil['visi'] ?? '' }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                <textarea name="misi" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ $profil['misi'] ?? '' }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-address-book text-gold-500 mr-2"></i>Kontak</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ $profil['alamat'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="telepon" value="{{ $profil['telepon'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $profil['email'] ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="px-6 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
    </div>
</form>
@endsection
