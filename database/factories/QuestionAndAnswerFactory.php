<?php

use Faker\Generator as Faker;

$factory->define(App\Models\QuestionAndAnswer::class, function (Faker $faker) {
    return [
        'photo' => $faker->imageUrl($width = 640, $height = 480),
        'question' => $faker->sentence(),
        'answer' => $faker->paragraph(),
    ];
});
