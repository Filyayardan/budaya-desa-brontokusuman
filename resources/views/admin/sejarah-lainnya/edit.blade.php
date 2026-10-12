@extends('admin.layouts.app')
@section('title', 'Edit Sejarah Lainnya')
@section('header', 'Edit Sejarah Lainnya')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.sejarah-lainnya.update', $sejarahLainnya) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $sejarahLainnya->judul) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $sejarahLainnya->urutan) }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                <textarea name="ringkasan" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('ringkasan', $sejarahLainnya->ringkasan) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="8" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('isi', $sejarahLainnya->isi) }}</textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                @if($sejarahLainnya->gambar)
                    <div class="relative group w-fit mb-2">
                        <img src="{{ asset('storage/' . $sejarahLainnya->gambar) }}" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                        <button type="button" data-field="hapus_gambar"
                            class="hapus-media absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition hover:bg-red-600"
                            title="Hapus gambar">&times;</button>
                    </div>
                    <input type="hidden" name="hapus_gambar" class="field-hapus-media" value="">
                @endif
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
            </div>
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4 text-sm text-red-600">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">Perbarui</button>
                <a href="{{ route('admin.sejarah-lainnya.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
