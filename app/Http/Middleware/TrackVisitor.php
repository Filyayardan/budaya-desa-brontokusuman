<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request);
        if ($request->is('admin*')) {
            return $next($request);
        }
        
        if (!session()->has('visitor_recorded')) {

            $now = now();

            Visitor::query()->insertOrIgnore([
                'session_id' => session()->getId(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            session()->put('visitor_recorded', true);
        }
        // insertOrIgnore() akan mengabaikan insert kedua jika session_id yang sama sudah masuk, sehingga tidak muncul error duplicate key saat request bersamaan.
        return $next($request);
    }
}