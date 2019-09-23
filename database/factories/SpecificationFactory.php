<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Specification::class, function (Faker $faker) {
    return [
        'key' => $faker->name(),
        'value' => $faker->company,
    ];
});
