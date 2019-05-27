<?php

use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "person_in_charge" => $faker->name,
        "address" => $faker->address,
        "phone" => $faker->phoneNumber,
        "high_risk" => $faker->boolean()
    ];
});
