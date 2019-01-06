<?php

use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'timeslot' => $faker->randomElement($array = array ("08-09", "09-10", "10-11", "11-12")),
        'patient_id' => $faker->randomNumber(4),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
