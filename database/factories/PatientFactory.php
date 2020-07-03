<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patients;
use Faker\Generator as Faker;

$factory->define(Patients::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'guardian_name' => $faker->name(),
        'age' => $faker->numberBetween(5, 35),
        'gender' => $faker->randomElement(['male', 'female']),
        'doctor_id' => $faker->randomElement([1, 2]),
        'user_id' => 1,
        'token' => 5
    ];
});
