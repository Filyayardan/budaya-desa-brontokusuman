<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $berita = $query->paginate(10)->withQueryString();
        $currentSubAdmin = $this->currentSubAdmin();
        return view('admin.berita.index', compact('berita', 'currentSubAdmin'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'penulis' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
        ], [
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
            'galeri.*.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'berita');
        }
        if ($request->hasFile('galeri')) {
            $validated['galeri'] = $this->storeGaleri($request->file('galeri'), 'berita');
        }
        $validated['featured'] = $request->boolean('featured');
        if ($subAdmin = $this->currentSubAdmin()) {
            $validated['created_by'] = $subAdmin->id;
        }
        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'penulis' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
        ]);

        if ($request->boolean('hapus_gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = null;
        }
        if ($request->hasFile('gambar')) {
            if (!$request->boolean('hapus_gambar') && $berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'berita');
        }
        $galeri = $berita->galeri ?? [];
        if ($request->filled('hapus_galeri')) {
            $hapus = json_decode($request->input('hapus_galeri'), true) ?? [];
            $this->deleteGaleri($berita->galeri, $hapus);
            $galeri = array_values(array_diff($galeri, $hapus));
        }
        if ($request->hasFile('galeri')) {
            $galeri = array_merge($galeri, $this->storeGaleri($request->file('galeri'), 'berita'));
        }
        $validated['galeri'] = $galeri;

        $validated['featured'] = $request->boolean('featured');
        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        abort_unless($this->canManage($berita), 403, 'Anda hanya dapat mengelola berita yang Anda upload.');
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $this->deleteGaleri($berita->galeri);
        foreach ($berita->subBerita as $sb) {
            if ($sb->gambar) {
                Storage::disk('public')->delete($sb->gambar);
            }
            $this->deleteGaleri($sb->galeri);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
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
