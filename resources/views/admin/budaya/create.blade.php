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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                <textarea name="deskripsi_lengkap" rows="5" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi_lengkap') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                    <input type="file" name="video" accept="video/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                    <p class="text-xs text-gray-400 mt-1">MP4, WebM, MOV (maks 500MB)</p>
                </div>
            </div>
            <div class="mb-4">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="unggulan" value="1" {{ old('unggulan') ? 'checked' : '' }} class="w-4 h-4 text-gold-600 rounded border-gray-300 focus:ring-gold-500">
                    <span class="text-sm text-gray-700">Jadikan Unggulan</span>
                </label>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">Simpan</button>
                <a href="{{ route('admin.budaya.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
