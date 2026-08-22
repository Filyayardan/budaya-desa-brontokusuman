<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcaraController extends Controller
{
    public function index(Request $request)
    {
        $query = Acara::latest('tanggal_mulai');

        if ($request->filled('search')) {
            $query->where('nama_acara', 'like', "%{$request->search}%");
        }
        if ($request->filled('status')) {
            $today = now()->toDateString();

            match ($request->status) {
                'upcoming' => $query->where('tanggal_mulai', '>', $today),
                'ongoing' => $query->where('tanggal_mulai', '<=', $today)
                    ->whereRaw('COALESCE(tanggal_selesai, tanggal_mulai) >= ?', [$today]),
                'completed' => $query->whereRaw('COALESCE(tanggal_selesai, tanggal_mulai) < ?', [$today]),
                default => null,
            };
        }

        $acara = $query->paginate(10)->withQueryString();
        return view('admin.acara.index', compact('acara'));
    }

    public function create()
    {
        return view('admin.acara.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('acara', 'public');
        }

        Acara::create($validated);

        return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil ditambahkan.');
    }

    public function edit(Acara $acara)
    {
        return view('admin.acara.edit', compact('acara'));
    }

    public function update(Request $request, Acara $acara)
    {
        $validated = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('gambar')) {
            if ($acara->gambar) {
                Storage::disk('public')->delete($acara->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('acara', 'public');
        }

        $acara->update($validated);

        return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil diperbarui.');
    }

    public function destroy(Acara $acara)
    {
        if ($acara->gambar) {
            Storage::disk('public')->delete($acara->gambar);
        }
        $acara->delete();
        return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil dihapus.');
    }
}
