<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {


    return [
        'description' => $this->faker->name,
        'company_name' => $this->faker->company,
        'address' => $this->faker->name,
        'city' => $this->faker->name,
        'state' => $this->faker->name,
        'phone' => $this->faker->name,
        'email' => $this->faker->name,
        'person_name' => $this->faker->name,
        'status' => $this->faker->boolean,
        'email_frequency' => $this->faker->numberBetween(0,2) // 0 no envios, 1 envio individual, 2 envio agrupado
    ];
});
