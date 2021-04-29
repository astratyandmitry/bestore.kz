<?php

use Domain\Shop\Models\City;
use Domain\Shop\Models\Packing;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\ProductPacking;
use Domain\Shop\Models\ProductRemain;
use Domain\Shop\Models\ProductTaste;
use Domain\Shop\Models\Taste;
use Illuminate\Database\Seeder;

class ProductStockSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        ProductTaste::query()->truncate();
        ProductPacking::query()->truncate();
        ProductRemain::query()->truncate();

        $products = Product::query()->get();

        /** @var \Domain\Shop\Models\Product $product */
        foreach ($products as $product) {
            $product->update(['count_views' => rand(100, 1000)]);

            $this->seedTastes($product);
            $this->seedPackings($product);
            $this->seedRemains($product);
        }
    }

    /**
     * @param \Domain\Shop\Models\Product $product
     * @return void
     */
    private function seedTastes(Product $product): void
    {
        $limit = rand(1, 3);
        $tastes = Taste::query()->inRandomOrder()->get();

        for ($i = 1; $i <= $limit; $i++) {
            ProductTaste::query()->create([
                'product_id' => $product->id,
                'taste_id' => $tastes[$i]->id,
            ]);
        }
    }

    /**
     * @param \Domain\Shop\Models\Product $product
     * @return void
     */
    private function seedPackings(Product $product): void
    {
        $limit = rand(1, 3);
        $packings = Packing::query()->inRandomOrder()->get();

        for ($i = 1; $i <= $limit; $i++) {
            $price = round(rand(5000, 30000), -3);
            $priceSale = 0;

            if (rand(1, 2) === 2) {
                $priceSale = round($price * 0.7, -2);
            }

            ProductPacking::query()->create([
                'product_id' => $product->id,
                'packing_id' => $packings[$i]->id,
                'price' => $price,
                'price_sale' => $priceSale,
            ]);
        }
    }

    /**
     * @param \Domain\Shop\Models\Product $product
     * @return void
     */
    private function seedRemains(Product $product): void
    {
        $cities = City::query()->get();

        /** @var \Domain\Shop\Models\City $city */
        foreach ($cities as $city) {
            foreach ($product->packing->fresh() as $packing) {
                foreach ($product->tastes->fresh() as $taste) {
                    ProductRemain::query()->create([
                        'product_id' => $product->id,
                        'packing_id' => $packing->packing_id,
                        'taste_id' => $taste->taste_id,
                        'city_id' => $city->id,
                        'quantity' => rand(0, 20),
                    ]);
                }
            }
        }
    }
}
