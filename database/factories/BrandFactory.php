<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->sentence(),
    ];
});
