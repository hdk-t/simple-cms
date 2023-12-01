<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Cache;

class AuthController extends Controller
{
    public function form(Request $request): View|RedirectResponse
    {
        $serverSession = Cache::get('admin-session-cache');
        $requestSession = $request->session()->get('admin-session');
        if(!empty($serverSession) &&
           !empty($requestSession) &&
           strcmp($requestSession, $serverSession) === 0)
        {
            return redirect()->route('admin.articles.index');
        }
        return view('admin.auth.form');
    }

    public function login(Request $request, LoginFormRequest $loginForm): RedirectResponse
    {
        $sessionUuid = Str::uuid();
        $sessionExpiryDate = now()->addMinutes(60 * 24 * 1);

        $request->session()->put('admin-session', $sessionUuid);
        Cache::put('admin-session-cache', $sessionUuid, $sessionExpiryDate);
        
        return redirect()->route('admin.articles.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin-session');
        Cache::forget('admin-session-cache');
        return redirect()->route('admin.auth.login');
    }
}
