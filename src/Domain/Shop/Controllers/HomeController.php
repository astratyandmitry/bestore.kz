<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Repositories\BannersRepository;
use Domain\Shop\Repositories\ProductsRepository;
use Domain\Shop\Repositories\CategoriesRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class HomeController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoriesRepository
     * @param \Domain\Shop\Repositories\BannersRepository $bannersRepository
     * @return \Illuminate\View\View
     */
    public function __invoke(
        ProductsRepository $productsRepository,
        CategoriesRepository $categoriesRepository,
        BannersRepository $bannersRepository
    ): View {
        $this->setup(PAGE_HOME);

        $this->layout->setTitle()->hideTitle()->hideBreadcrumbs();

        return $this->view('home.index', [
            'popularProducts' => $productsRepository->popular(),
            'latestProducts' => $productsRepository->latest(),
            'banners' => $bannersRepository->all(),
            'categories' => $categoriesRepository->parents(),
        ]);
    }
}
