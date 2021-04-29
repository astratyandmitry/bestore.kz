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
}
