<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
    /**
     * @param \Domain\Shop\Models\City $city
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeCity(City $city): RedirectResponse
    {
        Session::put(SHOP_SESSION_CITY, $city->id);

        return redirect()->back();
    }

}
