<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->text(255),
        'body' => $faker->paragraph(),
        'image' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
