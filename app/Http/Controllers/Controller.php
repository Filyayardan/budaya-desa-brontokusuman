<?php

namespace App\Http\Controllers;

use App\Models\SubAdmin;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function currentSubAdmin(): ?SubAdmin
    {
        if (Auth::guard('web')->check()) {
            return null;
        }

        return Auth::guard('subadmin')->user();
    }
}
