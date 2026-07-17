<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBudaya;
use Illuminate\Http\Request;

class KategoriBudayaController extends Controller
{
    public function index()
    {
        $kategori = KategoriBudaya::withCount('budaya')->latest()->paginate(10);
        return view('admin.kategori-budaya.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori-budaya.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ikon' => 'nullable|string|max:255',
        ]);

        KategoriBudaya::create($validated);

        return redirect()->route('admin.kategori-budaya.index')->with('success', 'Kategori budaya berhasil ditambahkan.');
    }

    public function edit(KategoriBudaya $kategori_budaya)
    {
        return view('admin.kategori-budaya.edit', ['kategori' => $kategori_budaya]);
    }

    public function update(Request $request, KategoriBudaya $kategori_budaya)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ikon' => 'nullable|string|max:255',
        ]);

        $kategori_budaya->update($validated);

        return redirect()->route('admin.kategori-budaya.index')->with('success', 'Kategori budaya berhasil diperbarui.');
    }

    public function destroy(KategoriBudaya $kategori_budaya)
    {
        $kategori_budaya->delete();
        return redirect()->route('admin.kategori-budaya.index')->with('success', 'Kategori budaya berhasil dihapus.');
    }
}
