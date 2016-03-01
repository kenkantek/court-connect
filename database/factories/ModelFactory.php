<?php

use App\Models\Auth\User;

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
        'username' => $faker->username,
        'email' => $faker->email,
        'password' => bcrypt(12345678),
        'remember_token' => str_random(40),
        'phone' => $faker->phoneNumber,
        'zip_code' => '700000',
        'gender' => rand(1, 2),
        'facebook' => "http://" . $faker->domainName,
        'google' => "http://" . $faker->domainName,
    ];
});
