<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::all()->pluck('value', 'key');
        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $fields = [
            'tentang_judul' => 'nullable|string|max:255',
            'tentang_isi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'penduduk' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ];

        $validated = $request->validate($fields);

        if ($request->hasFile('gambar')) {
            if (ProfilDesa::get('gambar')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(ProfilDesa::get('gambar'));
            }
            $validated['gambar'] = $request->file('gambar')->store('profil', 'public');
        }

        foreach ($validated as $key => $value) {
            if ($value !== null || $key !== 'gambar') {
                ProfilDesa::set($key, $value);
            }
        }

        return redirect()->route('admin.profil.index')->with('success', 'Profil desa berhasil diperbarui.');
    }
}
