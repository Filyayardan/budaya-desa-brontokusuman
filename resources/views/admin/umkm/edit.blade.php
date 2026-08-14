@extends('admin.layouts.app')
@section('title', 'Edit UMKM')
@section('header', 'Edit UMKM')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pemilik</label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', $umkm->pemilik) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori', $umkm->kategori) }}" list="kategori-umkm"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        <datalist id="kategori-umkm">
                            <option value="Kuliner">
                            <option value="Kuliner & Herbal">
                            <option value="Batik & Kerajinan">
                            <option value="Kerajinan">
                            <option value="Fashion">
                            <option value="Jasa">
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $umkm->kontak) }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $umkm->alamat) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Posisi di Peta
                    </label>

                    <div id="map" class="w-full h-80 rounded-xl border border-gray-300"></div>

                    <input type="hidden" name="latitude" id="latitude"
                        value="{{ old('latitude', $umkm->latitude ?? '') }}">
                    <input type="hidden" name="longitude" id="longitude"
                        value="{{ old('longitude', $umkm->longitude ?? '') }}">

                    <p class="text-xs text-gray-500 mt-2">Klik peta untuk menentukan lokasi UMKM.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">Perbarui</button>
                    <a href="{{ route('admin.umkm.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
