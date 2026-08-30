<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function canAccess(string $routeName): bool
    {
        return $this->contents->contains(function ($content) use ($routeName) {
            return fnmatch($content->judul, $routeName);
        });
    }
}
