<?php

use Faker\Generator as Faker;

$factory->define(App\NotificationType::class, function (Faker $faker) {
    return [
        "alias" => $faker->word,
        "level" => "danger"
    ];
});
