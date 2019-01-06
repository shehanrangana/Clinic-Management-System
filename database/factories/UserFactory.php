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
    return [
        'name' => $faker->name,
        'gender' => 'Male',
        'birthday' => $faker->date,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'contact_number' => $faker->phonenumber,
        'user_role' => $faker->randomElement($array = array (0,1,2,3,4,5)),
        'qualification' => $faker->word,
        'slmc_number' => $faker->randomNumber(5),
        'email_verified_at' => now(),
        'remember_token' => str_random(10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
