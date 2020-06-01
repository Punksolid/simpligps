<?php

/** @var Factory $factory */

use App\Model;
use App\Setting;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'key' => $faker->word,
        'value' => $faker->word,
        'description' => $faker->sentence
    ];
});
