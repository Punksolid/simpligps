<?php

use Faker\Generator as Faker;

$factory->define(\App\Account::class, function (Faker $faker) {
    return [
        "easyname" => $faker->word,
        "uuid" => $faker->uuid
    ];
});
