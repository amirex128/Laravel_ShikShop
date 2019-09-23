<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    // $faker = \Faker\Factory::create('fa_IR');
    return [
        'id' => $faker->ean8,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'phone' => '09105009868',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'mac_address' => $faker->macAddress,
        'type' => 0,
        'remember_token' => str_random(10),
    ];
});
