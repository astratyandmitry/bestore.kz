<?php

namespace Domain\Shop\Middleware;

use Closure;
use Ramsey\Uuid\Uuid;
use Domain\Shop\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopSetup
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var \Domain\Shop\Models\City $city */
        if (!Session::has(SHOP_SESSION_CITY) && $city = City::query()->first()) {
            Session::put(SHOP_SESSION_CITY, $city->id);
        }

        if (Auth::guard(SHOP_GUARD)->guest() && !Session::has(SHOP_SESSION_GUEST)) {
            Session::put(SHOP_SESSION_GUEST, Uuid::uuid1()->toString());
        }

        return $next($request);
    }
}
