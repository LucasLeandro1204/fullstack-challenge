<?php

use App\User;
use App\Category;
use App\Advertisement;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'title' => $faker->sentence,
        'price' => $faker->numberBetween(10000, 1000000),
        'description' => implode('\n', $faker->paragraphs),
    ];
});
