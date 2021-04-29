<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Product;
use Domain\Shop\Models\ProductStock;
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
     * @param string $hru
     * @return \Domain\Shop\Models\Product
     */
    public function findByHru(string $hru): Product
    {
        return Product::query()->where('hru', $hru)->firstOrFail();
    }

    /**
     * @param int $product_id
     * @param int $packing_id
     * @param int $taste_id
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
