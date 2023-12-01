<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\View\View;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|View
    {
        $username = $request->getUser();
        $password = $request->getPassword();

        if ($username == config('admin.admin_basic_auth_user') && $password == config('admin.admin_basic_auth_pass')) {
            return $next($request);
        }

        abort(401, headers: [
            header('WWW-Authenticate: Basic realm="Contents Management Page"'),
            header('Content-Type: text/html; charset=utf-8')
        ]);
    }
}
