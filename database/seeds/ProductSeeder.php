<?php

use Domain\Shop\Models\Product;
use Domain\Shop\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Product::query()->truncate();

        factory(Product::class, 50)->create();

        /** @var \Domain\Shop\Models\Product[] $products */
        $products = Product::query()->get();

        foreach ($products as $product) {
            if (rand(1, 2) === 2) {
                continue;
            }

            factory(Review::class, rand(1, 10))->create([
                'product_id' => $product->id,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
