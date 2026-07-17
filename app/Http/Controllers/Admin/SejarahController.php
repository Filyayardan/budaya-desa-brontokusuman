<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.sejarah.index', compact('sejarah'));
    }

    public function create()
    {
        return view('admin.sejarah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;
        Sejarah::create($validated);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil ditambahkan.');
    }

    public function edit(Sejarah $sejarah)
    {
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($sejarah->gambar) {
                Storage::disk('public')->delete($sejarah->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        $sejarah->update($validated);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil diperbarui.');
    }

    public function destroy(Sejarah $sejarah)
    {
        if ($sejarah->gambar) {
            Storage::disk('public')->delete($sejarah->gambar);
        }
        $sejarah->delete();
        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil dihapus.');
    }
}
