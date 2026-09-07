@extends('admin.layouts.app')
@section('title', 'Tambah Sub Berita')
@section('header', 'Tambah Sub Berita')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.berita.sub-berita.index', $berita) }}" class="text-sm text-gray-500 hover:text-gold-600"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.berita.sub-berita.store', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Sub Berita <span class="text-red-500">*</span></label>
                <input type="text" name="judul_sub" value="{{ old('judul_sub') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Dalam Berita (bisa pilih banyak foto)</label>
                <input type="file" name="galeri[]" accept="image/*" multiple class="galeri-input w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                <p class="mt-1 text-xs text-gray-400">Setelah upload, tulis <b>[foto1]</b>, <b>[foto2]</b>, dst. di dalam isi sub berita sesuai posisi foto yang diinginkan.</p>
                <div class="galeri-preview flex flex-wrap gap-2 mt-2"></div>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Sub Berita <span class="text-red-500">*</span></label>
                <textarea name="isi_sub" rows="10" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('isi_sub') }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Sisipkan <code>[foto1]</code>, <code>[foto2]</code>, dst. di tengah/akhir paragraf untuk menampilkan foto yang sudah diupload.</p>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">Simpan</button>
                <a href="{{ route('admin.berita.sub-berita.index', $berita) }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('.galeri-input');
        const preview = document.querySelector('.galeri-preview');

        input.addEventListener('change', function () {
            preview.innerHTML = '';
            Array.from(this.files).forEach((file, i) => {
                const url = URL.createObjectURL(file);
                const wrap = document.createElement('div');
                wrap.className = 'relative';
                const img = document.createElement('img');
                img.src = url;
                img.className = 'w-20 h-20 rounded-lg object-cover border border-gray-200';
                const num = document.createElement('span');
                num.textContent = 'foto' + (i + 1);
                num.className = 'absolute -top-2 left-0 bg-gold-600 text-white text-[10px] px-1 py-0.5 rounded';
                wrap.appendChild(num);
                wrap.appendChild(img);
                preview.appendChild(wrap);
            });
        });
    });
</script>
@endpush
