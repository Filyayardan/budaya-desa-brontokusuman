<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'judul_atas' => 'nullable|string|max:255',
            'judul_tengah' => 'nullable|string|max:255',
            'judul_bawah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'btn1_teks' => 'nullable|string|max:255',
            'btn1_link' => 'nullable|string|max:255',
            'btn2_teks' => 'nullable|string|max:255',
            'btn2_link' => 'nullable|string|max:255',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('banner', 'public');
        }

        $validated['aktif'] = $request->boolean('aktif');

        Banner::create($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'judul_atas' => 'nullable|string|max:255',
            'judul_tengah' => 'nullable|string|max:255',
            'judul_bawah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'btn1_teks' => 'nullable|string|max:255',
            'btn1_link' => 'nullable|string|max:255',
            'btn2_teks' => 'nullable|string|max:255',
            'btn2_link' => 'nullable|string|max:255',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($banner->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('banner', 'public');
        }

        $validated['aktif'] = $request->boolean('aktif');

        $banner->update($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($banner->gambar);
        }
        $banner->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.');
    }
}
