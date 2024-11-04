<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\IPBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RedirectIfBanned
{
    public const ALLOWED_ROUTES = [
        'auth.logout',
        'account.banned.index',
        'account.banned.reactivate'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = Cache::remember("ipban:{$request->ip()}", 3600, fn () => IPBan::where([
            ['ip', '=', $request->ip()],
            ['unbanner_id', '=', null]
        ])->exists());

        if ($ip) {
            return view('errors.500');
        }

        if (Auth::check() && Auth::user()->isBanned() && !in_array($request->route()->getName(), $this::ALLOWED_ROUTES)) {
            return redirect()->route('account.banned.index');
        }

        return $next($request);
    }
}
