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
        $pengurus = Pengurus::with('parent')->latest()->paginate(10);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        $atasanList = Pengurus::orderBy('nama')->get();
        return view('admin.pengurus.create', compact('atasanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:pengurus,id',
            'urutan' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp',
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

        $validated['parent_id'] = $request->filled('parent_id') ? $request->parent_id : null;
        $validated['urutan'] = $request->filled('urutan') ? (int) $request->urutan : 0;

        Pengurus::create($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        $atasanList = Pengurus::where('id', '!=', $pengurus->id)->orderBy('nama')->get();
        return view('admin.pengurus.edit', compact('pengurus', 'atasanList'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:pengurus,id',
            'urutan' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $parentId = $request->filled('parent_id') ? (int) $request->parent_id : null;

        if ($parentId === $pengurus->id) {
            return back()->withErrors(['parent_id' => 'Atasan tidak boleh merupakan pengurus itu sendiri.'])->withInput();
        }

        if ($this->isDescendant($pengurus->id, $parentId)) {
            return back()->withErrors(['parent_id' => 'Atasan tidak boleh berada di bawah pengurus ini (menyebabkan siklus struktur).'])->withInput();
        }

        if ($request->boolean('hapus_foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = null;
        }

        if ($request->hasFile('foto')) {
            if (!$request->boolean('hapus_foto') && $pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = app(ImageUploader::class)->store($request->file('foto'), 'pengurus');
        }

        $validated['parent_id'] = $parentId;
        $validated['urutan'] = $request->filled('urutan') ? (int) $request->urutan : 0;

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

    private function isDescendant($id, $targetParentId): bool
    {
        if (!$targetParentId) {
            return false;
        }

        $parents = Pengurus::pluck('parent_id', 'id')->toArray();
        $queue = [$id];

        while (count($queue)) {
            $current = array_shift($queue);
            foreach ($parents as $childId => $pid) {
                if ((int) $pid === (int) $current) {
                    if ((int) $childId === (int) $targetParentId) {
                        return true;
                    }
                    $queue[] = $childId;
                }
            }
        }

        return false;
    }
}
