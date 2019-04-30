<?php

use Faker\Generator as Faker;

$factory->define(App\NotificationTrigger::class, function (Faker $faker) {
    return [
        "name" => $faker->unique()->word.$faker->unique()->word,
        "active" => $faker->boolean,
        "level" => "danger"
    ];
});
