<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Design::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->sentence()
    ];
});
