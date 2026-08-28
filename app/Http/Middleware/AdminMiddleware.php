<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        if (!Auth::guard('subadmin')->check()) {
            return redirect()->route('admin.login');
        }

        $routeName = $request->route()?->getName();
        $subAdmin = Auth::guard('subadmin')->user();
        // --- CETAK DI SINI ---
        // dd($routeName);
        // dd($subAdmin);
        // ---------------------


        $allAccess = ['admin.dashboard', 'admin.logout'];

        if (
            !$routeName ||
            (
                !in_array($routeName, $allAccess, true) &&
                !$subAdmin->canAccess($routeName)
            )
        ) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');

     }


        return $next($request);
    }
}
