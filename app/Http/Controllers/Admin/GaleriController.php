<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $galeri = $query->paginate(12)->withQueryString();
        $kategoriList = Galeri::distinct()->pluck('kategori')->filter();
        $currentSubAdmin = $this->currentSubAdmin();

        return view('admin.galeri.index', compact('galeri', 'kategoriList', 'currentSubAdmin'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'video' => 'nullable|file|mimes:mp4,webm,mov,avi',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
        ]);

        if (!$request->hasFile('gambar') && !$request->hasFile('video')) {
            return back()->withErrors(['gambar' => 'Pilih file gambar atau video untuk diupload.'])->withInput();
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'galeri');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('galeri/video', 'public');
        }

        if ($subAdmin = $this->currentSubAdmin()) {
            $validated['created_by'] = $subAdmin->id;
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        abort_unless($this->canManage($galeri), 403, 'Anda hanya dapat mengelola galeri yang Anda upload.');
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        abort_unless($this->canManage($galeri), 403, 'Anda hanya dapat mengelola galeri yang Anda upload.');
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'video' => 'nullable|file|mimes:mp4,webm,mov,avi',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
        ]);

        if ($request->boolean('hapus_gambar')) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if (!$request->boolean('hapus_gambar') && $galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'galeri');
        }

        if ($request->boolean('hapus_video')) {
            if ($galeri->video) {
                Storage::disk('public')->delete($galeri->video);
            }
            $validated['video'] = null;
        }

        if ($request->hasFile('video')) {
            if (!$request->boolean('hapus_video') && $galeri->video) {
                Storage::disk('public')->delete($galeri->video);
            }
            $validated['video'] = $request->file('video')->store('galeri/video', 'public');
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        abort_unless($this->canManage($galeri), 403, 'Anda hanya dapat mengelola galeri yang Anda upload.');
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        if ($galeri->video) {
            Storage::disk('public')->delete($galeri->video);
        }
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    private function canManage(Galeri $galeri): bool
    {
        if (!$subAdmin = $this->currentSubAdmin()) {
            return true;
        }

        return $galeri->created_by === $subAdmin->id;
    }
}