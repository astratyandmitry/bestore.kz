<?php

use Domain\Shop\Models\Product;
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

        Schema::enableForeignKeyConstraints();
    }
}
