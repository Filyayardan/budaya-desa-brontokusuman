<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SejarahLainnya;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahLainnyaController extends Controller
{
    public function index(Request $request)
    {
        $query = SejarahLainnya::orderBy('urutan', 'asc')->latest('id');

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $sejarahLainnya = $query->paginate(10)->withQueryString();

        return view('admin.sejarah-lainnya.index', compact('sejarahLainnya'));
    }

    public function create()
    {
        return view('admin.sejarah-lainnya.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'sejarah-lainnya');
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;
        SejarahLainnya::create($validated);

        return redirect()->route('admin.sejarah-lainnya.index')->with('success', 'Sejarah lainnya berhasil ditambahkan.');
    }

    public function edit(SejarahLainnya $sejarahLainnya)
    {
        return view('admin.sejarah-lainnya.edit', compact('sejarahLainnya'));
    }

    public function update(Request $request, SejarahLainnya $sejarahLainnya)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->boolean('hapus_gambar')) {
            if ($sejarahLainnya->gambar) {
                Storage::disk('public')->delete($sejarahLainnya->gambar);
            }
            $validated['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if (!$request->boolean('hapus_gambar') && $sejarahLainnya->gambar) {
                Storage::disk('public')->delete($sejarahLainnya->gambar);
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'sejarah-lainnya');
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $sejarahLainnya->update($validated);

        return redirect()->route('admin.sejarah-lainnya.index')->with('success', 'Sejarah lainnya berhasil diperbarui.');
    }

    public function destroy(SejarahLainnya $sejarahLainnya)
    {
        if ($sejarahLainnya->gambar) {
            Storage::disk('public')->delete($sejarahLainnya->gambar);
        }
        $sejarahLainnya->delete();

        return redirect()->route('admin.sejarah-lainnya.index')->with('success', 'Sejarah lainnya berhasil dihapus.');
    }
}
