<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    public function index()
    {
        $backgrounds = Background::latest()->get();
        return view('admin.background.index', compact('backgrounds'));
    }

    public function create()
    {
        return view('admin.background.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'pola' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'background');
        }

        if ($request->hasFile('pola')) {
            $validated['pola'] = app(ImageUploader::class)->store($request->file('pola'), 'background');
        }

        $validated['aktif'] = $request->boolean('aktif');

        $background = Background::create($validated);

        if ($background->aktif) {
            Background::where('id', '!=', $background->id)->update(['aktif' => false]);
        }

        return redirect()->route('admin.background.index')->with('success', 'Background berhasil ditambahkan.');
    }

    public function edit(Background $background)
    {
        return view('admin.background.edit', compact('background'));
    }

    public function update(Request $request, Background $background)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'pola' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'aktif' => 'boolean',
        ]);

        foreach (['gambar', 'pola'] as $field) {
            if ($request->boolean('hapus_' . $field)) {
                if ($background->{$field}) {
                    Storage::disk('public')->delete($background->{$field});
                }
                $validated[$field] = null;
            }

            if ($request->hasFile($field)) {
                if (!$request->boolean('hapus_' . $field) && $background->{$field}) {
                    Storage::disk('public')->delete($background->{$field});
                }
                $validated[$field] = app(ImageUploader::class)->store($request->file($field), 'background');
            }
        }

        $validated['aktif'] = $request->boolean('aktif');

        $background->update($validated);

        if ($background->aktif) {
            Background::where('id', '!=', $background->id)->update(['aktif' => false]);
        }

        return redirect()->route('admin.background.index')->with('success', 'Background berhasil diperbarui.');
    }

    public function activate(Background $background)
    {
        Background::where('id', '!=', $background->id)->update(['aktif' => false]);
        $background->update(['aktif' => true]);

        return redirect()->route('admin.background.index')->with('success', "Background '{$background->nama}' diaktifkan.");
    }

    public function destroy(Background $background)
    {
        foreach (['gambar', 'pola'] as $field) {
            if ($background->{$field}) {
                Storage::disk('public')->delete($background->{$field});
            }
        }
        $background->delete();

        return redirect()->route('admin.background.index')->with('success', 'Background berhasil dihapus.');
    }
}