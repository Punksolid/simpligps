<?php

use Faker\Generator as Faker;

$factory->define(App\Device::class, function (Faker $faker) {
    return [
        "name" => $faker->name.$faker->unique()->randomNumber(5),
        "brand" => $faker->company
    ];
});
