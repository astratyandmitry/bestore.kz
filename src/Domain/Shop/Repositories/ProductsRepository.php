<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Category;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\ProductStock;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ProductsRepository
{
    /**
     * @param integer $id
     *
     * @return \Domain\Shop\Models\Product
     */
    public function findById(int $id): Product
    {
        return Product::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param string $hru
     *
     * @return \Domain\Shop\Models\Product
     */
    public function findByHru(string $hru): Product
    {
        return Product::query()->where('hru', $hru)->firstOrFail();
    }

    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     *
     * @return mixed
     */
    public function catalog(CatalogRequest $request)
    {
        return Product::query()->catalog($request)->paginate(24);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function popular(): Collection
    {
        return Product::query()->orderByDesc('count_views')->limit(12)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latest(): Collection
    {
        return Product::query()->orderByDesc('created_at')->limit(12)->get();
    }

    /**
     * @param int $product_id
     * @param int $packing_id
     * @param int $taste_id
     *
     * @return \Domain\Shop\Models\ProductStock
     */
    public function findStock(int $product_id, int $packing_id, int $taste_id): ProductStock
    {
        return ProductStock::query()
            ->where('city_id', Session::get('shop.city_id'))
            ->where('product_id', $product_id)
            ->where('packing_id', $packing_id)
            ->where('taste_id', $taste_id)
            ->where('quantity', '>', 0)
            ->first();
    }
}
