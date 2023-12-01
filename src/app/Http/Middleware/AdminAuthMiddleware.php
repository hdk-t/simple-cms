<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $serverSession = Cache::get('admin-session-cache');
        $requestSession = $request->session()->get('admin-session');
        if(!empty($serverSession) &&
           !empty($requestSession) &&
           strcmp($requestSession, $serverSession) === 0)
        {
            return $next($request);
        }
        return redirect()->route('admin.auth.form');
    }
}
