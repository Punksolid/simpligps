<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Account::class, function (Faker $faker) {
    return [
        "easyname" => $faker->word,
        "uuid" => $faker->uuid
    ];
});
