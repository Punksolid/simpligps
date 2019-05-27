<?php

use Faker\Generator as Faker;

$factory->define(App\NotificationTrigger::class, function (Faker $faker) {
    return [
        "name" => $faker->unique()->word.$faker->unique()->word,
        "active" => $faker->boolean,
        "level" => $faker->randomElement([
                'emergency', 
                'alert', 
                'critical', 
                'error', 
                'warning', 
                'notice', 
                'info', 
                'debug'
        ])
    ];
});
