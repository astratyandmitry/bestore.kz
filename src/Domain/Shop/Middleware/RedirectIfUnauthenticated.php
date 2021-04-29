<?php

namespace Domain\Shop\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfUnauthenticated
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard(SHOP_GUARD)->guest()) {
            return redirect()->route('shop::login');
        }

        return $next($request);
    }
}
