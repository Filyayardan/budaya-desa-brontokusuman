<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class SubAdmin extends Authenticatable
{
    protected $table = 'sub_admin';

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function contents()
    {
        return $this->belongsToMany(
            Content::class,
            'sub_admin_content',
            'sub_admin_id',
            'content_id'
        );
    }

    public function isSuperAdminFor(string $type): bool
    {
        return $this->contents->contains(
            fn($content) => $content->judul === 'admin.' . $type . '.*'
        );
    }

    public function budayaItemIds(): array
    {
        return $this->contents
            ->pluck('judul')
            ->filter(fn($judul) => str_starts_with($judul, 'budaya.item.'))
            ->map(fn($judul) => (int) Str::after($judul, 'budaya.item.'))
            ->unique()
            ->values()
            ->all();
    }

    public function canManageBudaya(int $budayaId): bool
    {
        if ($this->isSuperAdminFor('budaya')) {
            return true;
        }

        return in_array($budayaId, $this->budayaItemIds(), true);
    }

    public function canAccess(string $routeName): bool
    {
        if (in_array($routeName, ['admin.dashboard', 'admin.logout'], true)) {
            return true;
        }

        if (str_starts_with($routeName, 'admin.budaya.')) {
            return $this->isSuperAdminFor('budaya') || count($this->budayaItemIds()) > 0;
        }

        if (str_starts_with($routeName, 'admin.booking.')) {
            return $this->isSuperAdminFor('budaya') || count($this->budayaItemIds()) > 0;
        }

        if (str_starts_with($routeName, 'admin.umkm.')) {
            return $this->isSuperAdminFor('umkm');
        }

        if (str_starts_with($routeName, 'admin.berita.') || str_starts_with($routeName, 'admin.acara.') || str_starts_with($routeName, 'admin.galeri.')) {
            return true;
        }

        return $this->contents->contains(function ($content) use ($routeName) {
            return fnmatch($content->judul, $routeName);
        });
    }
}
