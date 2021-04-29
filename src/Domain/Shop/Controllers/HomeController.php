<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\AmbassadorsRepository;
use Domain\Shop\Repositories\CatalogRepository;
use Domain\Shop\Repositories\CategoriesRepository;
use Domain\Shop\Repositories\SlidesRepository;
use Illuminate\View\View;
use Domain\Shop\Models\Page;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class HomeController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoryRepository
     * @param \Domain\Shop\Repositories\CatalogRepository $catalogRepository
     * @param \Domain\Shop\Repositories\SlidesRepository $slidesRepository
     * @param \Domain\Shop\Repositories\AmbassadorsRepository $ambassadorsRepository
     * @return \Illuminate\View\View
     */
    public function __invoke(
        CategoriesRepository $categoryRepository,
        CatalogRepository $catalogRepository,
        SlidesRepository $slidesRepository,
        AmbassadorsRepository $ambassadorsRepository
    ): View {
        $this->setup(Page::HOME);

        $this->layout->setTitle()->hideTitle()->hideBreadcrumbs();

        return $this->view('home.index', [
            'categories' => $categoryRepository->parents(),
            'popularProducts' => $catalogRepository->popular(),
            'latestProducts' => $catalogRepository->latest(),
            'slides' => $slidesRepository->all(),
            'ambassadors' => $ambassadorsRepository->all(),
        ]);
    }
}
