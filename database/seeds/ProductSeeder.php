<?php

use Domain\Shop\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Product::query()->truncate();

        factory(Product::class, 50)->create();
    }
}
