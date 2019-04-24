<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Situation;
use Faker\Generator as Faker;

$factory->define(Situation::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
