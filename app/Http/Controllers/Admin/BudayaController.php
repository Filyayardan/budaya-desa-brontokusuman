<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budaya;
use App\Models\KategoriBudaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudayaController extends Controller
{
    public function index(Request $request)
    {
        $query = Budaya::with('kategori')->latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $budaya = $query->paginate(10)->withQueryString();
        $kategoriList = KategoriBudaya::all();

        return view('admin.budaya.index', compact('budaya', 'kategoriList'));
    }

    public function create()
    {
        $kategori = KategoriBudaya::all();
        return view('admin.budaya.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_budaya,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deskripsi_lengkap' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'lokasi' => 'nullable|string|max:255',
            'unggulan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('budaya', 'public');
        }

        $validated['unggulan'] = $request->boolean('unggulan');
        Budaya::create($validated);

        return redirect()->route('admin.budaya.index')->with('success', 'Budaya berhasil ditambahkan.');
    }

    public function edit(Budaya $budaya)
    {
        $kategori = KategoriBudaya::all();
        return view('admin.budaya.edit', compact('budaya', 'kategori'));
    }

    public function update(Request $request, Budaya $budaya)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_budaya,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deskripsi_lengkap' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'lokasi' => 'nullable|string|max:255',
            'unggulan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($budaya->gambar) {
                Storage::disk('public')->delete($budaya->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('budaya', 'public');
        }

        $validated['unggulan'] = $request->boolean('unggulan');
        $budaya->update($validated);

        return redirect()->route('admin.budaya.index')->with('success', 'Budaya berhasil diperbarui.');
    }

    public function destroy(Budaya $budaya)
    {
        if ($budaya->gambar) {
            Storage::disk('public')->delete($budaya->gambar);
        }
        $budaya->delete();
        return redirect()->route('admin.budaya.index')->with('success', 'Budaya berhasil dihapus.');
    }
}
