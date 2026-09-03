<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilKampung;
use App\Services\ImageUploader;
use Illuminate\Http\Request;

class ProfilKampungController extends Controller
{
    public function index()
    {
        $profil = ProfilKampung::all()->pluck('value', 'key');
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
            'foto_login' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ];

        $validated = $request->validate($fields);

        if ($request->hasFile('gambar')) {
            if (ProfilKampung::get('gambar')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(ProfilKampung::get('gambar'));
            }
            $validated['gambar'] = app(ImageUploader::class)->store($request->file('gambar'), 'profil');
        }

        if ($request->hasFile('foto_login')) {
            if (ProfilKampung::get('foto_login')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(ProfilKampung::get('foto_login'));
            }
            $validated['foto_login'] = app(ImageUploader::class)->store($request->file('foto_login'), 'profil');
        }

        foreach ($validated as $key => $value) {
            if ($value !== null || $key !== 'gambar') {
                ProfilKampung::set($key, $value);
            }
        }

        return redirect()->route('admin.profil.index')->with('success', 'Profil kampung berhasil diperbarui.');
    }
}
