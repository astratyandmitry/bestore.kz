<?php

namespace Domain\CMS\Middleware;

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
        if (Auth::guard('cms')->guest()) {
            return redirect()->route('cms::login');
        }

        return $next($request);
    }
}
