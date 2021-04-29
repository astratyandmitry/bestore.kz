<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ChangeCityController
{
    /**
     * @param string $hru
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $hru): RedirectResponse
    {
        /** @var \Domain\Shop\Models\City $city */
        $city = City::query()->where('hru', $hru)->firstOrFail();

        Session::put('shop.city_id', $city->id);

        return back();
    }
}
