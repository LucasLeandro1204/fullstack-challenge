<?php

use App\Field;
use App\Value;
use App\Advertisement;
use Faker\Generator as Faker;

$factory->define(Value::class, function (Faker $faker) {
    return [
        'field_id' => function () {
            return factory(Field::class)->create()->id;
        },
        'advertisement_id' => function () {
            return factory(Advertisement::class)->create()->id;
        },
    ];
});
