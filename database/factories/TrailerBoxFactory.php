<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TrailerBox;
use Faker\Generator as Faker;

$factory->define(TrailerBox::class, function (Faker $faker) {
    return [
        'plate' => $faker->randomNumber(6),
        'internal_number' => $faker->randomNumber(6),
        'carrier_id' => factory(\App\Carrier::class)->create()->id,
        'gps' => $faker->word
    ];
});
