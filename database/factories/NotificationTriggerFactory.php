<?php

use Faker\Generator as Faker;

$factory->define(App\NotificationTrigger::class, function (Faker $faker) {
    return [
        "alias" => $faker->unique()->word.$faker->unique()->word,
        "level" => "danger"
    ];
});
