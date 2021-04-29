<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => Category::query()->whereNotNull('parent_id')->inRandomOrder()->value('id'),
        'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        'badge_id' => rand(1, 2) === 2 ? Brand::query()->inRandomOrder()->value('id') : null,
        'name' => Str::title($title = $faker->words(3, true)),
        'hru' => Str::slug($title),
        'image' => '/storage/products/'.rand(2, 9).'.jpg',
        'about' => '<p>'.implode('</p></p>', $faker->paragraphs()).'</p>',
        'composition' => '<p>'.implode('</p></p>', $faker->paragraphs()).'</p>',
        'recommendation' => '<p>'.implode('</p></p>', $faker->paragraphs()).'</p>',
        'active' => true,
    ];
});
