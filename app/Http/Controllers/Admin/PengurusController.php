<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Services\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::latest()->paginate(10);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'telepon' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required_if:subAdminSelect,true|confirmed',
            'subAdminSelect' => 'required|boolean',
            'adminOption' => 'required_if:subAdminSelect,true|array|min:1',
            'adminOption.*' => 'string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = app(ImageUploader::class)->store($request->file('foto'), 'pengurus');
        }

        Pengurus::create($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = app(ImageUploader::class)->store($request->file('foto'), 'pengurus');
        }

        $pengurus->update($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        $pengurus->delete();
        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}
