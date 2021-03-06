<?php

use App\Models\Auth\User;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\Player;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'state' => $faker->state,
        'city' => $faker->city,
        'zip_code' => $faker->postcode,
        'address1' => $faker->address,
        'address2' => $faker->secondaryAddress,
        'password' => bcrypt(12345678),
        'remember_token' => str_random(40),
        'phone' => $faker->phoneNumber,
        'gender' => rand(1, 2),
    ];
});

$factory->define(Club::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'phone' => $faker->phoneNumber,
        'image' => '/uploads/images/clubs/no-image.jpg',
    ];
});

$factory->define(Court::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'status' => 1,
        'indoor_outdoor' => rand(1, 2),
        'surface_id' => rand(1, 2),
        'club_id' => rand(1, 10),
    ];
});
