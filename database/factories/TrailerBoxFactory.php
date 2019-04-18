<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TrailerBox;
use Faker\Generator as Faker;

$factory->define(TrailerBox::class, function (Faker $faker) {
    return [
        'plate' => (string)$faker->randomNumber(6),
        'internal_number' => (string) $faker->randomNumber(6),
        'carrier_id' => factory(\App\Carrier::class)->create()->id,
        'gps' => $faker->word
    ];
});
