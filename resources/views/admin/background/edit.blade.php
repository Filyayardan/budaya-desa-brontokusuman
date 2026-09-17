@extends('admin.layouts.app')
@section('title', 'Edit Background')
@section('header', 'Edit Background')

@section('content')
<form action="{{ route('admin.background.update', $background) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-info-circle text-gold-500 mr-2"></i>Informasi Background</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Background <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $background->nama) }}" placeholder="Contoh: Batik Coklat Tua" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                        @if($background->gambar)
                            <div class="relative group mb-3">
                                <img src="{{ asset('storage/' . $background->gambar) }}" class="w-full h-32 rounded-lg object-cover">
                                <button type="button" data-field="hapus_gambar"
                                    class="hapus-media absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition hover:bg-red-600"
                                    title="Hapus gambar">&times;</button>
                            </div>
                            <input type="hidden" name="hapus_gambar" class="field-hapus-media" value="">
                        @else
                            <p class="text-gray-400 text-sm mb-3">Belum ada gambar.</p>
                        @endif
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar <span class="text-gray-400">(opsional)</span></label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pola</label>
                        @if($background->pola)
                            <div class="relative group mb-3">
                                <img src="{{ asset('storage/' . $background->pola) }}" class="w-full h-32 rounded-lg object-cover">
                                <button type="button" data-field="hapus_pola"
                                    class="hapus-media absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition hover:bg-red-600"
                                    title="Hapus pola">&times;</button>
                            </div>
                            <input type="hidden" name="hapus_pola" class="field-hapus-media" value="">
                        @else
                            <p class="text-gray-400 text-sm mb-3">Belum ada pola.</p>
                        @endif
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Pola <span class="text-gray-400">(opsional)</span></label>
                        <input type="file" name="pola" accept="image/*"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP.</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center"><i class="fas fa-power-off text-gold-500 mr-2"></i>Status</h3>
                <div>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="aktif" value="1" {{ old('aktif', $background->aktif) ? 'checked' : '' }} class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <span class="text-sm text-gray-700">Jadikan aktif di website</span>
                    </label>
                    <p class="text-xs text-gray-400 mt-2">Jika aktif, background lain otomatis nonaktif.</p>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <a href="{{ route('admin.background.index') }}" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium text-center hover:bg-gray-50">Batal</a>
                <button type="submit" class="flex-1 px-4 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection