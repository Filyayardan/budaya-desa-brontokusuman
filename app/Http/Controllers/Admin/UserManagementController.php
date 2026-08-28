<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\SubAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    private const ADMIN_OPTIONS = [
        'admin.budaya.*',
        'admin.umkm.*',
        'admin.berita.*',
        'admin.acara.*',
        'admin.galeri.*',
        'admin.pengunjung.*',
    ];

    public function index()
    {
        $subAdmin = SubAdmin::with('contents')
            ->latest()
            ->paginate(10);

        return view('admin.user-management.index', compact('subAdmin'));
    }

    public function create()
    {
        return view('admin.user-management.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'max:255',
                'unique:sub_admin,username',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
                'string',
            ],
            'adminOption' => [
                'required',
                'array',
                'min:1',
            ],
            'adminOption.*' => [
                'required',
                'string',
                'distinct',
                Rule::in(self::ADMIN_OPTIONS),
            ]], [

    'email.unique' => 'Username ini sudah terdaftar di sistem.',
    'email.required' => 'Kolom Username wajib diisi.',

        ]);

        DB::transaction(function () use ($validated) {
            $subAdmin = SubAdmin::create([
                'username' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $contentIds = collect($validated['adminOption'])
                ->map(function (string $route) {
                    return Content::firstOrCreate([
                        'judul' => $route,
                    ])->id;
                });

            $subAdmin->contents()->sync($contentIds);
        });

        return redirect()
            ->route('admin.userManagement.index')
            ->with('success', 'Sub-admin berhasil ditambahkan.');
    }

    public function destroy(SubAdmin $subAdmin)
    {
        DB::transaction(function () use ($subAdmin) {
            $subAdmin->contents()->detach();
            $subAdmin->delete();
        });

        return redirect()
            ->route('admin.userManagement.index')
            ->with('success', 'Sub-admin berhasil dihapus.');
    }

    public function edit(SubAdmin $subAdmin)
    {
        return view('admin.user-management.edit', compact('subAdmin'));
    }

    public function update(Request $request, SubAdmin $subAdmin)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_admin', 'username')->ignore($subAdmin->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:255',
                'confirmed',
            ],
            'adminOption' => [
                'required',
                'array',
                'min:1',
            ],
            'adminOption.*' => [
                'required',
                'string',
                'distinct',
                Rule::in(self::ADMIN_OPTIONS),
    ]], [

    'email.unique' => 'Username ini sudah terdaftar di sistem.',
    'email.required' => 'Kolom Username wajib diisi.',

        ]);

        DB::transaction(function () use ($validated, $subAdmin) {
            $data = [
                'username' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $subAdmin->update($data);

            $contentIds = collect($validated['adminOption'])
                ->map(function (string $route) {
                    return Content::firstOrCreate([
                        'judul' => $route,
                    ])->id;
                });

            $subAdmin->contents()->sync($contentIds);
        });

        return redirect()
            ->route('admin.userManagement.index')
            ->with('success', 'Sub-admin berhasil diperbarui.');
    }
}
