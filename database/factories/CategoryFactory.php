<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->sentence(),
        'icon' => $faker->imageUrl(100, 100),
        'banner' => $faker->imageUrl(300, 800)
    ];
});
