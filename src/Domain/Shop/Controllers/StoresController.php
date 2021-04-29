<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\City;
use Domain\Shop\Models\Page;
use Domain\Shop\Models\Store;
use Domain\Shop\Repositories\CitiesRepository;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class StoresController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\CitiesRepository $citiesRepository
     * @return \Illuminate\View\View
     */
    public function __invoke(CitiesRepository $citiesRepository): View
    {
        $this->setup(Page::STORES);

        $cities = $citiesRepository->all()->toArray();

        return $this->view('store.index', [
            'cities' => $cities,
        ]);
    }
}
