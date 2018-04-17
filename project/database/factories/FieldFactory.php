<?php

use App\Field;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'type' => 'range',
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
    ];
});
