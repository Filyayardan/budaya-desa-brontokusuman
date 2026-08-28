<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'judul',
    ];

    public $timestamps = false;

    public function subAdmins()
    {
        return $this->belongsToMany(
            SubAdmin::class,
            'sub_admin_content',
            'content_id',
            'sub_admin_id'
        );
    }
}
