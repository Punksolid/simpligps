<?php

use App\TruckTract;
use Faker\Generator as Faker;

$factory->define(App\Device::class, function (Faker $faker) {
    return [
        "name" => $faker->name.$faker->unique()->randomNumber(5),
        "brand" => $faker->company,
        'internal_number' => $faker->randomNumber(5)
    ];
});

$factory->state(App\Device::class, 'in_truck', function ($faker) {
    return [
        'wialon_id' => 17471332,
        'deviceable_id' => factory(TruckTract::class),
        'deviceable_type' => 'trucks',
    ];
});
