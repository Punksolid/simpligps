<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name,
        'company' => $this->faker->company,
        'phone' => $this->faker->phoneNumber,
        'contact' => 'esto para que?',
        'email' => $this->faker->email,
        'address' => $this->faker->address
    ];
});
