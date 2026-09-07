@extends('admin.layouts.app')
@section('title', 'Edit Berita')
@section('header', 'Edit Berita')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                    @if($berita->gambar)
                    <div class="relative group w-fit mb-2">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                        <button type="button" data-field="hapus_gambar"
                            class="hapus-media absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition hover:bg-red-600"
                            title="Hapus gambar">&times;</button>
                    </div>
                    <input type="hidden" name="hapus_gambar" class="field-hapus-media" value="">
                    @endif
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Dalam Berita (bisa pilih banyak foto)</label>
                @if(!empty($berita->galeri))
                <div class="galeri-existing flex flex-wrap gap-2 mb-2">
                    @foreach($berita->galeri as $idx => $path)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $path) }}" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                        <span class="absolute -top-2 left-0 bg-gold-600 text-white text-[10px] px-1 py-0.5 rounded">foto{{ $idx + 1 }}</span>
                        <button type="button" data-src="{{ $path }}" class="hapus-galeri absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition">&times;</button>
                    </div>
                    @endforeach
                </div>
                @endif
                <input type="file" name="galeri[]" accept="image/*" multiple class="galeri-input w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                <p class="mt-1 text-xs text-gray-400">Tulis <b>[foto1]</b>, <b>[foto2]</b>, dst. di dalam isi berita untuk menampilkan foto di posisi yang diinginkan. Centang silang untuk menghapus foto.</p>
                <input type="hidden" name="hapus_galeri" class="hapus-galeri-field" value="">
                <div class="galeri-preview flex flex-wrap gap-2 mt-2"></div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                <textarea name="ringkasan" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="10" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('isi', $berita->isi) }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Sisipkan <code>[foto1]</code>, <code>[foto2]</code>, dst. di tengah/akhir paragraf untuk menampilkan foto yang sudah diupload.</p>
            </div>
            <div class="mb-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $berita->featured) ? 'checked' : '' }} class="w-4 h-4 text-gold-600 rounded border-gray-300 focus:ring-gold-500">
                    <span class="text-sm text-gray-700">Berita Unggulan</span>
                </label>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">Perbarui</button>
                <a href="{{ route('admin.berita.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
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
        const field = document.querySelector('.hapus-galeri-field');

        input.addEventListener('change', function () {
            preview.innerHTML = '';
            const existingCount = document.querySelectorAll('.galeri-existing .relative').length;
            Array.from(this.files).forEach((file, i) => {
                const url = URL.createObjectURL(file);
                const wrap = document.createElement('div');
                wrap.className = 'relative';
                const img = document.createElement('img');
                img.src = url;
                img.className = 'w-20 h-20 rounded-lg object-cover border border-gray-200';
                const num = document.createElement('span');
                num.textContent = 'foto' + (existingCount + i + 1);
                num.className = 'absolute -top-2 left-0 bg-gold-600 text-white text-[10px] px-1 py-0.5 rounded';
                wrap.appendChild(num);
                wrap.appendChild(img);
                preview.appendChild(wrap);
            });
        });

        document.querySelectorAll('.hapus-galeri').forEach(btn => {
            btn.addEventListener('click', function () {
                const src = this.getAttribute('data-src');
                this.closest('.relative').remove();
                const existing = JSON.parse(field.value || '[]');
                existing.push(src);
                field.value = JSON.stringify(existing);
            });
        });
    });
</script>
@endpush
