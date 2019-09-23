<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Product::class, function (FakerEng $faker) {
    // $faker = \Faker\Factory::create('fa_IR');
    $price = $faker->numberBetween(1000, 20000000);

    return [
        'id'            => $faker->numberBetween(10000000, 99999999),
        'name'          => $faker->name,
        'description'   => $faker->sentence(),
        'price'         => $price,
        'offer'         => $faker->numberBetween(1000, $price),
        'link'          => $faker->url,
        'photo'         => $faker->imageUrl(480, 320),
        'gallery'       => [ $faker->imageUrl(480, 320), $faker->imageUrl(480, 320) ],
        'special'       => $faker->boolean,
        'status'        => $faker->boolean,
        'views_count'   => $faker->numberBetween(0, 1000),
    ];
});
