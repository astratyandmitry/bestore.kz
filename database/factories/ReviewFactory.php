<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Review;
use Domain\Shop\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => User::query()->inRandomOrder()->value('id'),
        'message' => $faker->sentence(20),
        'rating' => rand(1, 5),
        'active' => true,
    ];
});
