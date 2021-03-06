<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\OrdersRepository;
use Illuminate\View\View;
use Domain\Shop\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Domain\Shop\Requests\BasketRequest;
use Domain\Shop\Repositories\BasketRepository;
use Domain\Shop\Repositories\ProductsRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class BasketController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\OrdersRepository $repository
     * @return \Illuminate\View\View
     */
    public function index(OrdersRepository $repository): View
    {
        $this->setup(PAGE_BASKET);

        return $this->view('basket.index', [
            'baskets' => app('basket')->getItems()->toArray(),
            'order_prev' => $repository->last(),
        ]);
    }

    /**
     * @param \Domain\Shop\Requests\BasketRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function decrease(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        list ($basket) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        if ($basket->count > 1) {
            $basket->count--;

            $basketRepository->updateCount($basket->id, $basket->count);
        }

        return response()->json([
            'count' => $basket->count,
        ]);
    }

    /**
     * @param \Domain\Shop\Requests\BasketRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        list ($basket, $stock) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        if ($basket->count < $stock->quantity) {
            $basket->count++;

            $basketRepository->updateCount($basket->id, $basket->count);
        }

        return response()->json([
            'count' => $basket->count,
        ]);
    }

    /**
     * @param \Domain\Shop\Requests\BasketRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        list ($basket, $stock) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        $count = (int) $request->get('quantity', 1);

        if ($count > $stock->quantity) {
            $count = $stock->quantity;
        }

        $basket->count = $count;

        $basketRepository->updateCount($basket->id, $basket->count);

        return response()->json([
            'count' => $basket->count,
        ]);
    }

    /**
     * @param \Domain\Shop\Requests\BasketRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return array
     */
    protected function prepareUpdate(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): array {
        $stock = $productsRepository->findStock(
            $request->product_id,
            $request->packing_id,
            $request->taste_id
        );

        $basket = $basketRepository->findByStock($stock);

        return [$basket, $stock];
    }

    /**
     * @param int $id
     * @param \Domain\Shop\Repositories\BasketRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, BasketRepository $repository): Response
    {
        $repository->deleteById($id);

        return response()->noContent();
    }
}
