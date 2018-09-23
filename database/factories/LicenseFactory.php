<?php

use Faker\Generator as Faker;

$factory->define(App\License::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->text,
        "lapse" => 10,
        "modules" => "string_cambiar",
        "units" => 10,
        "number_active_sessions" => 10,
        "uuid" => $faker->uuid
    ];

});
