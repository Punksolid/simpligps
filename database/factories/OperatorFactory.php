<?php

use Faker\Generator as Faker;

$factory->define(App\Operator::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "phone" => $faker->phoneNumber,
        "active" => $faker->boolean
    ];
});
