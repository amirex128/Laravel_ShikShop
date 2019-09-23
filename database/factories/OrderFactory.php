<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Order::class, function (FakerEng $faker) {
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'admin_description' => $faker->sentence(),
        'buyer_description' => $faker->sentence(),
        'destination' => $faker->address(),
        'postal_code' => $faker->postcode,
        'total' => $faker->numberBetween(10000, 10000000),
        'status' => $faker->numberBetween(0, 7),
        'created_at' => $faker->dateTime(),
    ];
});
