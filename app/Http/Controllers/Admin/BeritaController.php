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
        return view('admin.berita.index', compact('berita'));
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
            'penulis' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
        ], [
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'berita');
        }
        $validated['featured'] = $request->boolean('featured');
        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'penulis' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'berita');
        }
        $validated['featured'] = $request->boolean('featured');
        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
