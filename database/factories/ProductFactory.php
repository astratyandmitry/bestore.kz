<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => Category::query()->inRandomOrder()->value('id'),
        'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        'name' => Str::title($title = $faker->words(3, true)),
        'hru' => Str::slug($title),
        'image' => '/images/products/'.rand(1, 6).'.jpeg',
        'price' => $price = round(rand(5000, 50000), 2),
        'price_sale' => rand(1, 2) === 2 ? null : $price - rand(1000, 5000),
        'quantity' => rand(10, 100),
        'about' => '<p>'.implode('</p></p>', $faker->paragraphs()).'</p>',
        'active' => true,
    ];
});
