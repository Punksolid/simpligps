<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\CancelationReason;
use Faker\Generator as Faker;

$factory->define(CancelationReason::class, function (Faker $faker) {
    return [
        "name" => $faker->name()
    ];
});
