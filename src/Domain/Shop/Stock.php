<?php

namespace Domain\Shop;

use Domain\Shop\Models\Product;
use Domain\Shop\Repositories\BasketRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Stock
{
    /**
     * @param \Domain\Shop\Models\Product $product
     *
     * @return array
     */
    public function load(Product $product): array
    {
        $existsStockKeys = (new BasketRepository)->existsStockKeys();

        $product->load(['stocks', 'stocks.taste', 'stocks.packing']);

        $stocks = [];

        if ($product->stocks->isEmpty()) {
            return $stocks;
        }

        foreach (array_values($product->stocks->groupBy('packing.id')->toArray()) as $items) {
            $tastes = [];

            foreach ($items as $item) {
                $stockKey = "{$product->id}.{$items[0]['packing']['id']}.{$item['taste']['id']}";

                $tastes[] = [
                    'id' => $item['taste']['id'],
                    'name' => $item['taste']['name'],
                    'quantity' => $item['quantity'],
                    'basket' => isset($existsStockKeys[$stockKey]) ? $existsStockKeys[$stockKey] : 0,
                ];
            }

            $stocks[] = [
                'id' => $items[0]['packing']['id'],
                'name' => $items[0]['packing']['name'],
                'price' => price($items[0]['price']),
                'price_sale' => $items[0]['price_sale'] ? price($items[0]['price_sale']) : null,
                'tastes' => $tastes,
            ];
        }

        return $stocks;
    }
}
