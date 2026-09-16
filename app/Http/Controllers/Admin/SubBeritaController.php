<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\SubBerita;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubBeritaController extends Controller
{
    public function index(Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        $subBerita = $berita->subBerita()->latest()->paginate(10);
        return view('admin.berita.sub-berita.index', compact('berita', 'subBerita'));
    }

    public function create(Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        return view('admin.berita.sub-berita.create', compact('berita'));
    }

    public function store(Request $request, Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        $validated = $request->validate([
            'judul_sub' => 'required|string|max:255',
            'isi_sub' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['berita_id'] = $berita->id;
        $validated['urutan'] = $request->input('urutan', 0);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'sub-berita');
        }
        if ($request->hasFile('galeri')) {
            $validated['galeri'] = $this->storeGaleri($request->file('galeri'), 'sub-berita');
        }

        SubBerita::create($validated);

        return redirect()->route('admin.berita.sub-berita.index', $berita)->with('success', 'Sub berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita, SubBerita $subBerita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        return view('admin.berita.sub-berita.edit', compact('berita', 'subBerita'));
    }

    public function update(Request $request, Berita $berita, SubBerita $subBerita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        $validated = $request->validate([
            'judul_sub' => 'required|string|max:255',
            'isi_sub' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['urutan'] = $request->input('urutan', 0);

        if ($request->boolean('hapus_gambar')) {
            if ($subBerita->gambar) {
                Storage::disk('public')->delete($subBerita->gambar);
            }
            $validated['gambar'] = null;
        }
        if ($request->hasFile('gambar')) {
            if (!$request->boolean('hapus_gambar') && $subBerita->gambar) {
                Storage::disk('public')->delete($subBerita->gambar);
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'sub-berita');
        }
        $galeri = $subBerita->galeri ?? [];
        if ($request->filled('hapus_galeri')) {
            $hapus = json_decode($request->input('hapus_galeri'), true) ?? [];
            $this->deleteGaleri($subBerita->galeri, $hapus);
            $galeri = array_values(array_diff($galeri, $hapus));
        }
        if ($request->hasFile('galeri')) {
            $galeri = array_merge($galeri, $this->storeGaleri($request->file('galeri'), 'sub-berita'));
        }
        $validated['galeri'] = $galeri;

        $subBerita->update($validated);

        return redirect()->route('admin.berita.sub-berita.index', $berita)->with('success', 'Sub berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita, SubBerita $subBerita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        if ($subBerita->gambar) {
            Storage::disk('public')->delete($subBerita->gambar);
        }
        $this->deleteGaleri($subBerita->galeri);
        $subBerita->delete();

        return redirect()->route('admin.berita.sub-berita.index', $berita)->with('success', 'Sub berita berhasil dihapus.');
    }

    private function canManage(Berita $berita): bool
    {
        if (!$subAdmin = $this->currentSubAdmin()) {
            return true;
        }

        return $berita->created_by === $subAdmin->id;
    }

    private function storeGaleri(array $files, string $directory): array
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = app(ImageUploader::class)->store($file, $directory);
        }
        return $paths;
    }

    private function deleteGaleri(?array $galeri, ?array $only = null): void
    {
        if (!$galeri) {
            return;
        }
        foreach ($galeri as $path) {
            if ($only !== null && !in_array($path, $only)) {
                continue;
            }
            Storage::disk('public')->delete($path);
        }
    }
}
