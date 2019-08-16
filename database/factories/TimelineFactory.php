<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Timeline::class, function (Faker $faker) {
    return [
        'place_id' => factory(\App\Place::class)->create(['geofence_ref' => '17471233_4'])->id,
        'trip_id' => factory(\App\Trip::class)->create()->id,
        'at_time' => now(),
        'exiting' => now(),
        'real_at_time' => now(),
        'real_exiting' => now(),
        'type' => $faker->randomElement(['origin','intermediate','destination']),
        'order' => $faker->randomNumber(2),
    ];
});
